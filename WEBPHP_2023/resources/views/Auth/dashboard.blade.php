@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header">{{Auth::user()->role}} Dashboard</div>
                <div class="card-body">

                    @switch(Auth::user()->role)
                        @case('customer')

                        @break
                        @case('employee')
                        <p>Label List</p>
                        <p>Package list</p>
                        @break
                        @case('deliverer')
                        <p>Package list</p>
                        @break
                    @endswitch

                    @if (Auth::user()->role == 'superadmin')
                        <div class="row mx-3">
                            <p class="col">UserList</p>
                            <a href="{{ route('getUsers') }}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'employee')
                        <div class="row mx-3 mt-1">
                            <p class="col">Packages</p>
                            <a class="btn btn-secondary col-1"> ></a>
                        </div>
                        <div class="row mx-3 mt-1">
                            <p class="col">Labels</p>
                            <button class="btn btn-secondary col-1"> ></button>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'webshop')
                        <div class="row mx-3 mt-1">
                            <p class="col">Packages</p>
                            <a href="{{route('getPackages')}}" class="btn btn-secondary col-1"> ></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
