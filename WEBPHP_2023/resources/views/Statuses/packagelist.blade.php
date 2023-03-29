@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> Status List
                </div>
                <div class="card-body">
                    <div class="p-3 list-box mb-3">
                        <p class="ml-3">Your deliveries</p>
                        <hr>
                        <div class="row mx-3">
                            <p class="col-1 p-3">ID:</p>
                            <p class="col-2 p-3">Status:</p>
                            <p class="col-3 p-3">Destination:</p>
                            <p class="col-2 p-3">Dimensions:</p>
                            <p class="col-2 p-3">Weight:</p>
                        </div>
                        <hr>
                        @foreach($packages as $package)
                            @if ($package->status != 'Submitted' && $package->status != 'Label printed')
                                @if ($package->status == 'Delivered to customer')
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">{{$package->id}}</p>
                                        <p class="col-2 p-3">{{$package->status}}</p>
                                        <p class="col-3 p-3">{{$package->customerStreet}} {{$package->customerHousenumber}} {{$package->customerCity}}</p>
                                        <p class="col-2 p-3">{{$package->dimensions}}</p>
                                        <p class="col-2 p-3">{{$package->weight}}</p>
                                    </div>
                                @else
                                    <a class="link" href="{{route('getUpdateStatusView', [$package->id])}}">
                                        <div class="row mx-3 list-item">
                                            <p class="col-1 p-3">{{$package->id}}</p>
                                            <p class="col-2 p-3">{{$package->status}}</p>
                                            <p class="col-3 p-3">{{$package->customerStreet}} {{$package->customerHousenumber}} {{$package->customerCity}}</p>
                                            <p class="col-2 p-3">{{$package->dimensions}}</p>
                                            <p class="col-2 p-3">{{$package->weight}}</p>
                                        </div>
                                    </a>
                                @endif

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
