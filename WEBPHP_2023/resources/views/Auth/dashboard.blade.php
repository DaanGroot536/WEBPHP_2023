@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header">{{Auth::user()->role}} Dashboard</div>
                <div class="card-body">

                    @if (Auth::user()->role == 'superadmin')
                        <div class="row mx-3">
                            <p class="col">UserList</p>
                            <a href="{{ route('getUserView') }}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'employee' || Auth::user()->role == 'customer')
                        <div class="row mx-3 mt-1">
                            <p class="col">Packages</p>
                            <a href="{{route('getPackages')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'employee')

                        <div class="row mx-3 mt-1">
                            <p class="col">Labels</p>
                            <a href="{{route('getLabels')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">Plan Pickups</p>
                            <a href="{{route('getPickupView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">Customer List</p>
                            <a href="{{route('getCustomerView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif

                    @if (Auth::user()->role == 'webshop')
                        <div class="row mx-3 mt-1">
                            <p class="col">Packages</p>
                            <a href="{{route('getPackages')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'deliverer')
                        <div class="row mx-3 mt-1">
                            <p class="col">Status list</p>
                            <a href="{{route('getStatusView')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
