<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Label;

use App\Models\Pickup;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Dompdf\Dompdf;

use Milon\Barcode\DNS1D;

class LabelController extends Controller
{
    public function getLabels(Request $request)
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
        $labels = Label::all();
        return view('labels.labellist', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $originalSortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities,
            'fulltext' => $request->fulltext,
            'labels' => $labels,
        ]);
    }

    public function resetLabelFilters()
    {
        session()->forget(['status', 'city', 'sort_field', 'sort_order']);
        return redirect()->route('getLabels');
    }

    public function saveLabel(Request $request)
    {
        $this->saveLabelToDB($request->packageID, $request->deliverer);
        return redirect('/packageList');
    }

    public function saveLabelBulk(Request $request)
    {
        $packages = Package::all();
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                $this->saveLabelToDB($package->id, $request->delivererBulk);
            }
        }

        return redirect('/packageList');
    }

    public function printLabelBulk(Request $request)
    {
        $packages = Package::all();
        $labels = [];
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                array_push($labels, $package);
            }
        }


        if(count($labels) <= 0) {
            return redirect()->back()->with('error', 'ui.no_labels');
        }
        
        $this->generatePDF($labels);

        return redirect('/packageList');
    }

    private function saveLabelToDB($packageID, $deliverer)
    {
        $label = Label::create([
            'packageID' => $packageID,
            'deliverer' => $deliverer
        ]);
        Package::where('id', $packageID)->update([
            'labelID' => $label->id,
            'status' => 'Label printed',
        ]);
    }

    public function generatePDF($packages)
    {
        // Create a new instance of the Dompdf class
        $htmls = [];
        $temp = [];

        foreach ($packages as $package) {
            // Define the label HTML content
            $html = '
    <div class="label page">
        <h1>PRIORITY MAIL</h1>
        <div style="float:left;width:50%;">
            <p><strong>Sender: </strong>' . $package->webshopName . '</p>
            <p><strong>Address: </strong>' . $package->webshopStreet . ' ' . $package->webshopHousenumber . '</p>
            <p><strong>City: </strong>' . $package->webshopCity . '</p>
            <p><strong>Zip: </strong>' . $package->webshopZipcode . '</p>
        </div>
        <div style="float:right;width:50%;text-align:right;">
        <img src="" alt="QR Code" />
            <p><strong>Weight: </strong>' . $package->weight . '</p>
            <p><strong>Dimensions: </strong>' . $package->dimensions . '</p>
        </div>
        <div style="clear:both;"></div>
        <div class="divider"></div>
        <div class="address">
            <p><strong>Recipient: </strong>' . $package->customerName . '</p>
            <p><strong>Address: </strong>' . $package->customerStreet . ' ' . $package->customerHousenumber . '</p>
            <p><strong>City: </strong>' . $package->customerCity . '</p>
            <p><strong>Zip: </strong>' . $package->customerZipcode . '</p>
        </div>
        <div class="divider"></div>
        <div class="barcode">' . DNS1D::getBarcodeHTML($package->trackandtracecode, 'C39') . ' </div>
        <div class="barcode-code">' . $package->id . '</div>
        <div class="divider"></div>
        <div class="track-trace">Track &amp; Trace: ' . $package->trackandtracecode . '</div>
    </div><div class="page-break"></div>';
            array_push($htmls, $html);
            $documentName = 'label_' . strval($package->labelID) . '.pdf';
            array_push($temp, $documentName);
        }

        $newhtml = '';
        // Load the label HTML content into the Dompdf object
        foreach ($htmls as $html) {
            $newhtml = $newhtml . $html;
        }
        $finalhtml = '<style>
        /* Define styles for the label */
        .label {
        position: relative;
        display: inline-block;
        width: 100mm;
            height: 150mm;
            border: 1px solid #000;
            margin: 5mm;
            padding: 5mm;
            font-family: Arial, sans-serif;
        }
        .label h1 {
        font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5mm;
            text-align: center;
        }
        .label p {
        margin: 0;
        line-height: 1.2;
            font-size: 11pt;
        }
        .label .address {
        margin-bottom: 5mm;
        }
        .label .divider {
        height: 1px;
            border-top: 1px solid #000;
            margin: 5mm 0;
        }
        .label .barcode {
        margin: auto;
        display: block;
        height: 30px;
          }
        .label .barcode-code {
        text-align: center;
            font-size: 10pt;
            margin-top: 2mm;
        }
        .label .track-trace {
        text-align: center;
            font-size: 10pt;
        }
            .page-break {
        page-break-after: always;
    }
    </style>' . $newhtml;

        $pdf = new Dompdf();
        $pdf->loadHtml($finalhtml);
        // Set the paper size and orientation (landscape)
        $pdf->setPaper('A4');
        // Render the HTML content into a PDF
        $pdf->render();
        // Set the document name based on the label ID

        // Output the PDF to the browser with the unique document name
        $pdf->stream($documentName);
    }
}
