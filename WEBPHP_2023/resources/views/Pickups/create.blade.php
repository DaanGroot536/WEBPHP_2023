@extends('auth.layouts')

@section('content')

    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPickupView') }}">{{ __('ui.plan_pickups') }}</a> ->
                            {{ __('ui.create_pickup') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPickupView') }}">{{ __('ui.plan_pickups') }}</a> ->
                            {{ __('ui.create_pickup') }}
                    </div>
                @endif
                <div class="w-75 mx-auto my-5">
                    @if ($packages == null)
                        <p>{{ __('ui.id') }}: {{ $package->id }}</p>
                        <p>{{ __('ui.status') }}: {{ __('ui.status_' . strtolower($package->status)) }}</p>
                        <p>{{ __('ui.dimensions') }}: {{ $package->dimensions }}</p>
                        <p>{{ __('ui.weight_in_grams') }}: {{ $package->weight }}</p>
                    @else
                        @foreach ($packages as $package)
                            <div class="row mx-3 list-item">
                                <p class="col-1 p-3">{{ __('ui.id') }}: {{ $package->id }}</p>
                                <p class="col-2 p-3">{{ __('ui.status') }}: {{ __('ui.status_' . strtolower($package->status)) }}</p>
                                <p class="col-2 p-3">{{ __('ui.dimensions') }}: {{ $package->dimensions }}</p>
                                <p class="col-2 p-3">{{ __('ui.weight') }}: {{ $package->weight }}</p>
                            </div>
                        @endforeach
                    @endif
                    <br>
                    <form action="{{ route('savePickupBulk') }}" method="post" class="w-50">
                        @csrf
                        <input type="number" name="packageID" value="{{ $package->id }}" hidden>
                        <label>{{ __('ui.date') }}</label>
                        <input class="form-control" type="date" name="date" min="{{ $mindate }}" value="{{$mindate}}">
                        <label>{{ __('ui.time') }}</label>
                        <input class="form-control mt-1" type="time" name="time" min="00:00" max="15:00"
                            value="00:00" step="900">
                        <label>Address</label>
                        <input dusk="address" class="form-control mt-1" type="text" required="required" name="address" placeholder="address">
                        <label>Postcode</label>
                        <input dusk="postcode" class="form-control mt-1" type="text" maxlength="6" minlength="6"  required="required" name="postcode" placeholder="postcode">
                        <input dusk="submit" type="submit" class="btn btn-success mt-1" value="{{ __('ui.plan_pickup') }}">
                        @foreach ($packages as $package)
                            <input type="number" name="{{ $package->id }}" value="{{ $package->id }}" hidden>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
