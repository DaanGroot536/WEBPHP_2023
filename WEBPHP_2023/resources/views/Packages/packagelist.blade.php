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
                        <a href="{{route('getCreatePackageView')}}" class="btn btn-success">Create Package +</a>
                        <a href="{{route('getBulkImportView')}}" class="btn btn-success">Bulk Import</a>
                    @endif
                    @if (Auth::user()->role == 'employee')
                        <div class="row">
                            <p>Select packages for bulk labels. Next press the button to submit</p>
                        </div>
                    @endif
                    <p></p>
                    <div class="row mx-4">
                        @if (Auth::user()->role == 'employee')
                            <div class="col-2 p-0">
                                <form action="{{route('saveLabelBulk')}}" method="post" class="mt-2">
                                    @csrf
                                    <select class="form-control d-inline-block w-40" name="delivererBulk">
                                        <option value="DHL">DHL</option>
                                        <option value="PostNL">PostNL</option>
                                        <option value="DPD">DPD</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                    <input type="submit" class="btn btn-secondary mb-1 w-50"
                                           value="Create Bulk">

                                    <div class="checklist">
                                        @foreach($packages as $package)
                                            <div class="row">
                                                <div class="col"></div>
                                                <div class="checkitem col">
                                                    @if($package->labelID == null)
                                                        <input type="checkbox" class="packageCheck"
                                                               name="{{$package->id}}"
                                                               value="true">
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="p-3 list-box col-12 mb-3">
                            <p class="ml-3">Package List:</p>
                            <hr>
                            @foreach($packages as $package)
                                <div class="row mx-3 list-item">
                                    <p class="col-1 p-2"><strong>ID:</strong> {{$package->id}}</p>
                                    <p class="col-2 p-2"><strong>Status:</strong> {{$package->status}}</p>
                                    <p class="col-2 p-2"><strong>dimensions:</strong> {{$package->dimensions}}</p>
                                    <p class="col-2 p-2"><strong>Weight:</strong> {{$package->weight}}</p>
                                    <p class="col-5 p-2"><strong>Delivery Address:</strong> {{$package->full_customer_address}}</p>
                                    @if (Auth::user()->role == 'employee')
                                        @if($package->labelID == null)
                                            <div class="col-4 p-2">
                                                <form action="{{route('saveLabel')}}" method="post">
                                                    @csrf
                                                    <select class="form-control d-inline-block w-25" name="deliverer">
                                                        <option value="DHL">DHL</option>
                                                        <option value="PostNL">PostNL</option>
                                                        <option value="DPD">DPD</option>
                                                        <option value="UPS">UPS</option>
                                                    </select>
                                                    <input type="number" value="{{$package->id}}" name="packageID"
                                                           hidden>
                                                    <input type="submit" class="btn btn-secondary mb-1"
                                                           value="Create Label">
                                                </form>

                                            </div>
                                        @else
                                            <div class="col-4 p-2">
                                                @php
                                                    $temp = false
                                                @endphp
                                                @foreach ($pickups as $pickup)
                                                    @if($pickup->packageID == $package->id)
                                                        @php
                                                            $temp = true
                                                        @endphp
                                                        <p class="d-inline-block">Pickup planned!</p>
                                                    @endif
                                                @endforeach
                                                @if(!$temp)
                                                    <p class="mt-2">Label Created!</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
