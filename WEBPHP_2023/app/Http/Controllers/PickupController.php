<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Label;
use App\Models\Package;
use App\Models\Pickup;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public function getPickupView(Request $request)
    {
        // get sorting field
        $originalSortField = $request->get('sort_field', session('sort_field', 'id'));
        $sortField = $originalSortField;
        $sortOrder = 'asc'; // default sort order

        if ($request->formused == 'true') {
            // if sorting field is reversed, set sortOrder to desc
            if (strpos($sortField, 'reversed') !== false) {
                $sortOrder = 'desc';
                // remove the 'reversed' suffix from the sortField name
                $sortField = str_replace('reversed', '', $sortField);
            }
        } else {
            if (session()->get('sort_order') != null) {
                $sortOrder = session()->get('sort_order');

            } else {
                $sortOrder = 'asc';
            }
        }


        if ($request->fulltext) {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::search($request->searchtext)->get();
                $packages = $packages->where('webshopName', Auth::user()->name);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('customerEmail', Auth::user()->email);
                } else {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('webshopName', Auth::user()->company);
                }
            }
        }
        else {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::where('webshopName', Auth::user()->name)->orderBy($sortField, $sortOrder);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::where('customerEmail', Auth::user()->email)->orderBy($sortField, $sortOrder);
                } else {
                    $packages = Package::where('webshopName', Auth::user()->company)->orderBy($sortField, $sortOrder);
                }
            }

            // apply filters
            if ($request->has('status') && $request->status !== '' && $request->status !== null) {
                $packages = $packages->where('status', strtolower($request->status));
                session(['status' => $request->status]);
            } elseif (session()->has('status')) {
                $packages = $packages->where('status', strtolower(session('status')));
            }

            if ($request->has('city') && $request->city !== '' && $request->city !== null) {
                $packages = $packages->where('customerCity', $request->city);
                session(['city' => $request->city]);
            } elseif (session()->has('city')) {
                $packages = $packages->where('customerCity', session('city'));
            }
            $packages = $packages->simplePaginate(10); // 10 items per page
        }

        // get all status filter options
        $statuses = Status::pluck('description', 'id');

        // get all city filter options
        $cities = Package::distinct('customerCity')->pluck('customerCity');



        // store old values in session variables
        session([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder
        ]);

        $pickups = Pickup::all();
        return view('pickups.pickuplist', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $originalSortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities,
            'fulltext' => $request->fulltext
        ]);
    }

    public function resetPickupFilters()
    {
        session()->forget(['status', 'city', 'sort_field', 'sort_order']);

        return redirect()->route('getPickupView');
    }

    public function getCreatePickupView($id)
    {
        $package = Package::find($id);
        $minDate = date('Y-m-d', strtotime('+3 days'));
        return view('pickups.create', ['package' => $package, 'mindate' => $minDate]);
    }

    public function getCalendarView()
    {
        $pickups = Pickup::all();
        $date = date('Y-m-d');
        $daysforcalendar = $this->setDays($date);
        return view('pickups.calendar', ['days' => $daysforcalendar, 'pickups' => $pickups, 'date' => $date]);
    }

    public function changeCalendarWeek(Request $request)
    {
        switch ($request->direction) {
            case null:
                $currentDay = date('Y-m-d');
                break;
            case 'up':
                $currentDay = date('Y-m-d', strtotime($request->date . '+7 days'));
                break;
            case 'down':
                $currentDay = date('Y-m-d', strtotime($request->date . '-7 days'));
                break;
        }
        $pickups = Pickup::all();
        $daysforcalendar = $this->setDays($currentDay);
        return view('pickups.calendar', ['days' => $daysforcalendar, 'pickups' => $pickups, 'date' => $currentDay]);
    }

    // public function savePickup(Request $request)
    // {
    //     $pickupDateTime = $request->date . '-' . $request->time;

    //     Pickup::create([
    //         'packageID' => $request->packageID,
    //         'pickup_datetime' => $pickupDateTime
    //     ]);

    //     return redirect()->route('getPickupView');
    // }

    public function savePickupBulk(Request $request)
    {
        $pickupDateTime = $request->date . '-' . $request->time;
        $packagesForPickup = [];
        $packages = Package::all();
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                array_push($packagesForPickup, $package);
            }
        }

        foreach ($packagesForPickup as $package) {
            $pickup = Pickup::create([
                'packageID' => $package->id,
                'pickup_datetime' => $pickupDateTime,
                'pickup_address' => $request->address . ' ' . $request->postcode,

            ]);
            Package::where('id', $package->id)->update([
                'pickupID' => $pickup->id,
                'status' => 'Delivered to warehouse',
            ]);
        }

        return redirect()->route('getPickupView');
    }

    public function getCreatePickupBulk(Request $request)
    {
        $packagesForPickup = [];

        if (Auth::user()->role == 'webshop') {
            $packages = Package::where('webshopName', Auth::user()->name)->get();

        } else {
            $packages = Package::where('webshopName', Auth::user()->company)->get();
        }

        $minDate = date('Y-m-d', strtotime('+3 days'));
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                array_push($packagesForPickup, $package);
            }
        }

        if(count($packagesForPickup) <= 0) {
            return redirect()->back()->with('error', 'ui.no_labels');
        }

        return view('pickups.create', ['packages' => $packagesForPickup, 'mindate' => $minDate]);
    }

    public function setDays($currentDay)
    {
        $dayofweek = date('l');
        $daysforcalendar = [];

        switch ($dayofweek) {
            case 'Monday':
                $dayamount = 0;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Tuesday':
                $dayamount = 1;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Wednesday':
                $dayamount = 2;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Thursday':
                $dayamount = 3;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Friday':
                $dayamount = 4;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Saturday':
                $dayamount = 5;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
            case 'Sunday':
                $dayamount = 6;
                $highlight = $dayofweek;
                $daysforcalendar = $this->fillDays($dayamount, $highlight, $currentDay);
                break;
        }

        return $daysforcalendar;
    }

    public function fillDays($dayamount, $highlight, $currentDay)
    {
        $tempdate = date_create($currentDay);
        $daysforcalendar = [];
        for ($i = 0; $i < 7; $i++) {
            $tempi = $i - $dayamount;
            $day = new Day();
            $day->date = date('Y-m-d', strtotime($currentDay . "+" . $tempi . " days"));
            $day->dayofweek = date('l', strtotime($currentDay . "+" . $tempi . " days"));
            $day->highlight = $highlight;
            $daysforcalendar[$i] = $day;
        }

        return $daysforcalendar;
    }
}
