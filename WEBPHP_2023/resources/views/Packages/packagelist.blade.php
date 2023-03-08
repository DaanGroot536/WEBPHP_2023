@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> PackageList
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'webshop')
                        <a href="{{route('createPackage')}}" class="btn btn-success">Create Package +</a>
                    @endif
                </div>
                <div class="p-3 m-3 list-box">
                    <p class="ml-3">Package List:</p>
                    <hr>
                    @foreach($packages as $package)
                        <a class="link">
                            <div class="my-1 row mx-3 list-item">
                                <p class="col-1 p-3">ID: {{$package->id}}</p>
                                <p class="col-3 p-3">Status: {{$package->status}}</p>
                                <p class="col-1 p-3">Width: {{$package->width}}</p>
                                <p class="col-1 p-3">Length: {{$package->length}}</p>
                                <p class="col-1 p-3">Height: {{$package->height}}</p>
                                <p class="col-1 p-3">Weight: {{$package->weight}}</p>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
