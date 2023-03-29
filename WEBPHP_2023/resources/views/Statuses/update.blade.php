@extends('auth.layouts')

@section('content')
    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                            Dashboard</a> -> <a class="link" href="{{route('getStatusView')}}">Status List</a> -> Update
                        Status
                    </div>
                @else
                    <div class="card-header"><a class="link"
                                                href="{{route('dashboard')}}">{{Auth::user()->name}}
                            Dashboard</a> -> <a class="link" href="{{route('getStatusView')}}">Status List</a> -> Update
                        Status
                    </div>
                @endif
                <div class="card-body">
                    <div class="row mx-4">
                        <div class="p-3 list-box col-10 mb-3">
                            <div class="row mx-3 list-item">
                                <p class="col-1 p-3">ID: {{$package->id}}</p>
                                <p class="col-2 p-3">Status: {{$package->status}}</p>
                                <p class="col-3 p-3">
                                    Destination: {{$package->customerStreet}} {{$package->customerHousenumber}} {{$package->customerCity}}</p>
                                <p class="col-2 p-3">Dimensions: {{$package->dimensions}}</p>
                                <p class="col-2 p-3">Weight: {{$package->weight}}</p>
                            </div>
                            @foreach($statuses as $status)
                                @if($status->description != 'Submitted' && $status->description != 'Label printed' && $status->description != 'Delivered to warehouse' && $status->description != $package->status)
                                    <div class="w-25">
                                        <form action="{{route('updateStatus')}}" method="post">
                                            @csrf
                                            <input type="text" value="{{$status->description}}" name="status" hidden>
                                            <input class="w-100 mt-3 btn btn-secondary" type="submit"
                                                   value="{{$status->description}}">
                                            <input type="number" value="{{$package->id}}" name="packageID" hidden>
                                            <input type="text" value="{{Auth::user()->api_token}}" name="api_token"
                                                   hidden>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
