@extends('auth.layouts')

@section('content')

    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> <a class="link" href="{{route('getPackages')}}">PackageList</a> -> Create Pickup
                </div>
                <div class="w-75 mx-auto my-5">
                    <p>ID: {{$package->id}}</p>
                    <p>Status: {{$package->status}}</p>
                    <p>dimensions: {{$package->dimensions}}</p>
                    <p>Weight: {{$package->weight}}</p>
                    <br>
                    <form action="{{route('savePickup')}}" method="post" class="w-50">
                        @csrf
                        <input type="number" name="packageID" value="{{$package->id}}" hidden>
                        <label>Date</label>
                        <input class="form-control" type="date" name="date" min="{{$mindate}}">
                        <label>Time</label>
                        <input class="form-control mt-1" type="time" name="time" min="00:00" max="15:00" value="00:00" step="900">
                        <input type="submit" class="btn btn-success mt-1" value="Plan Pickup">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
