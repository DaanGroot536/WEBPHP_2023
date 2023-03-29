@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> Customer List
                </div>
                <div class="p-3 m-3 list-box">
                    @if(Auth::user()->role == 'webshop')
                        <p class="ml-3">{{Auth::user()->name}} Customer List:</p>
                    @else
                        <p class="ml-3">{{Auth::user()->company}} Customer List:</p>
                    @endif
                    <hr>
                    <div class="row mx-3">
                        <p class="col-3 p-3">Username:</p>
                        <p class="col-3 p-3">Email:</p>
                        <p class="col-3 p-3">Address:</p>
                    </div>
                    @foreach($packages as $package)
                        @foreach($package as $package2)
                            <a class="link" href="">
                                <div class="my-1 row mx-3 list-item">
                                    <p class="col-3 p-3">{{$package2->customerName}}</p>
                                    <p class="col-3 p-3">{{$package2->customerEmail}}</p>
                                    <p class="col-3 p-3">{{$package2->customerStreet}} {{$package2->customerHousenumber}} {{$package2->customerCity}}</p>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
