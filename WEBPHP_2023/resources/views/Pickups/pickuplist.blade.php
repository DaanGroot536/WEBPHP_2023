@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> Plan Pickups
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'employee')
                        <div class="row">
                            <p>Select packages for bulk pickups. Next press the button to submit</p>
                        </div>
                    @endif
                    <p></p>
                    <div class="row mx-4">
                        @if (Auth::user()->role == 'employee')
                            <div class="col-2 p-0">
                                <form action="{{route('getCreatePickupBulk')}}" method="post" class="mt-2">
                                    @csrf
                                    <div class=" d-inline-block w-40"></div>
                                    <input type="submit" class="btn btn-secondary mb-1 w-50"
                                           value="Plan">

                                    <div class="checklist">
                                        @foreach($packages as $package)
                                            @if($package->pickupID == null)
                                                <div class="row id{{$package->id}}">
                                                    <div class="col"></div>
                                                    <div class="checkitem col">
                                                        @if($package->labelID != null)
                                                            <input type="checkbox" class="packageCheck"
                                                                   name="{{$package->id}}"
                                                                   value="true">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="p-3 list-box col-10 mb-3">
                            <p class="ml-3">Package List:</p>
                            <hr>
                            @foreach($packages as $package)
                                @if($package->pickupID == null)
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">ID: {{$package->id}}</p>
                                        <p class="col-2 p-3">Status: {{$package->status}}</p>
                                        <p class="col-2 p-3">dimensions: {{$package->dimensions}}</p>
                                        <p class="col-2 p-3">Weight: {{$package->weight}}</p>
                                        @if (Auth::user()->role == 'employee')
                                            @if($package->labelID == null)
                                                <p class="col-2 mt-3">Create a label first!</p>
                                            @endif
                                        @endif
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
