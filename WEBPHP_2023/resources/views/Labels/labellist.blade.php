@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> LabelList
                </div>
                <div class="card-body">
                    @foreach($packages as $package)
                        @if($package->labelID != null)
                            <div class="row mx-3 list-item">
                                <p class="col-1 p-3">ID: {{$package->id}}</p>
                                <p class="col-2 p-3">Status: {{$package->status}}</p>
                                <p class="col-2 p-3">dimensions: {{$package->dimensions}}</p>
                                <p class="col-2 p-3">Weight: {{$package->weight}}</p>
                                <div class="col-2 p-2">
                                    <a class="btn btn-secondary">Show/Print Label</a>
                                </div>
                                @endif
                            </div>
                            @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
