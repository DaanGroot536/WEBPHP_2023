@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee' || Auth::user()->role == 'packer')
                    <div class="card-header">{{Auth::user()->company}} {{ __('ui.dashboard') }}</div>
                @else
                    <div class="card-header">{{Auth::user()->name}} {{ __('ui.dashboard') }}</div>
                @endif
                <div class="card-body">

                    @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'webshop')
                        <div class="row mx-3">
                            <p class="col">{{ __('ui.users') }}</p>
                            <a dusk="userlist" href="{{ route('getUserView') }}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'employee' || Auth::user()->role == 'customer' || Auth::user()->role == 'packer')
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.packages') }}</p>
                            <a dusk="packagelist" href="{{route('getPackages')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'customer')
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.reviews') }}</p>
                            <a href="{{route('getReviewView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'employee')

                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.labels') }}</p>
                            <a dusk="labellist" href="{{route('getLabels')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.plan_pickups') }}</p>
                            <a dusk="pickuplist" href="{{route('getPickupView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.customers') }}</p>
                            <a href="{{route('getCustomerView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.pickup_calendar') }}</p>
                            <a href="{{route('getCalendarView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.delivered_packages') }}</p>
                            <a href="{{route('getDeliveredPackagesView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'packer')
                            <div class="row mx-3 mt-1">
                                <p class="col">{{ __('ui.labels') }}</p>
                                <a href="{{route('getLabels')}}" class="btn btn-secondary col-1"> ></a>
                            </div>
                    @endif

                    @if (Auth::user()->role == 'webshop')
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.packages') }}</p>
                            <a dusk="packagelist" href="{{route('getPackages')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.customers') }}</p>
                            <a href="{{route('getCustomerView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.delivered_packages') }}</p>
                            <a href="{{route('getDeliveredPackagesView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'deliverer')
                        <div class="row mx-3 mt-1">
                            <p class="col">{{ __('ui.status_list') }}</p>
                            <a dusk="statuslist" href="{{route('getStatusView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
