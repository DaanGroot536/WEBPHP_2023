@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                            Dashboard</a> -> Delivered packages
                    </div>
                @else
                    <div class="card-header"><a class="link"
                                                href="{{route('dashboard')}}">{{Auth::user()->name}}
                            Dashboard</a> -> Delivered packages
                    </div>
                @endif
                <div class="card-body">
                    <div class="row mx-4">
                        <div class="p-3 list-box col-10 mb-3">
                            <p class="ml-3">Delivered Packages</p>
                            <hr>
                            @foreach($packages as $package)
                                @if ($package->status == 'Delivered to customer')
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">ID: {{$package->id}}</p>
                                        <p class="col-2 p-3">Status: {{$package->status}}</p>
                                        <p class="col-2 p-3">dimensions: {{$package->dimensions}}</p>
                                        <p class="col-2 p-3">Weight: {{$package->weight}}</p>
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
