@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> Status List
                </div>
                <div class="card-body">
                    <div class="row mx-4">
                        <div class="p-3 list-box col-10 mb-3">
                            <p class="ml-3">Your deliveries</p>
                            <hr>
                            @foreach($packages as $package)
                                <a class="link" href="{{route('getUpdateStatusView', [$package->id])}}">
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">ID: {{$package->id}}</p>
                                        <p class="col-3 p-3">Status: {{$package->status}}</p>
                                        <p class="col-2 p-3">dimensions: {{$package->dimensions}}</p>
                                        <p class="col-2 p-3">Weight: {{$package->weight}}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
