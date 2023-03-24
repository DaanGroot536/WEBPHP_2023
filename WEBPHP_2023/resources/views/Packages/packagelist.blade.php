@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->role }}
                        Dashboard</a> -> PackageList
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'webshop')
                        <a href="{{ route('getCreatePackageView') }}" class="btn btn-success">Create Package +</a>
                        <a href="{{ route('getBulkImportView') }}" class="btn btn-success">Bulk Import</a>
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
                                <form action="{{ route('saveLabelBulk') }}" method="post" class="mt-2">
                                    @csrf
                                    <select class="form-control d-inline-block w-40" name="delivererBulk">
                                        <option value="DHL">DHL</option>
                                        <option value="PostNL">PostNL</option>
                                        <option value="DPD">DPD</option>
                                        <option value="UPS">UPS</option>
                                    </select>
                                    <input type="submit" class="btn btn-secondary mb-1 w-50" value="Create Bulk">

                                    <div class="checklist">
                                        @foreach ($packages as $package)
                                            <div class="row">
                                                <div class="col"></div>
                                                <div class="checkitem col">
                                                    @if ($package->labelID == null)
                                                        <input type="checkbox" class="packageCheck"
                                                            name="{{ $package->id }}" value="true">
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="p-3 list-box col-12 mb-3">

                            <form class="row" action="{{ route('getPackages') }}" method="GET">
                                <div class="form-group">
                                    <label for="sort_field">Sort by:</label>
                                    <select class="form-control w-25 col-2" name="sort_field" id="sort_field">
                                        <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>ID</option>
                                        <option value="status" {{ $sortField == 'status' ? 'selected' : '' }}>Status
                                        </option>
                                        <option value="weight" {{ $sortField == 'weight' ? 'selected' : '' }}>Weight
                                        </option>
                                        <option value="customerCity" {{ $sortField == 'customerCity' ? 'selected' : '' }}>
                                            City</option>
                                        <option
                                            value="customerStreet"{{ $sortField == 'customerStreet' ? 'selected' : '' }}>
                                            Street</option>
                                        <option
                                            value="customerZipcode"{{ $sortField == 'customerZipcode' ? 'selected' : '' }}>
                                            Zipcode</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary col-1" type="submit">Sort</button>
                            </form>
                            <form class="col-2" method="GET" action="{{ route('getPackages') }}">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Select status --</option>
                                    @foreach ($statuses as $id => $description)
                                        <option value="{{ $description }}"
                                            @if (strtolower($description) === strtolower(request('status'))) selected @endif> {{ strtolower($description) }}</option>
                                    @endforeach
                                </select>

                                <label for="city">City:</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="">-- Select city --</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}"
                                            @if ($city === request('city')) selected @endif>{{ $city }}</option>
                                    @endforeach
                                </select>


                                <button class="btn btn-primary mt-1" type="submit">Filter</button>
                            </form>

                            <form class="col-2" action="{{ route('resetFilters') }}" method="GET">
                                <input type="hidden" name="reset" value="1">
                                <button class="btn btn-primary mt-1" type="submit">Reset filters</button>
                            </form>

                            <p class="ml-3">Package List:</p>
                            <hr>
                            @foreach ($packages as $package)
                                <div class="row mx-3 list-item">
                                    <p class="col-1 p-2"><strong>ID:</strong> {{ $package->id }}</p>
                                    <p class="col-2 p-2"><strong>Status:</strong> {{ $package->status }}</p>
                                    <p class="col-2 p-2"><strong>dimensions:</strong> {{ $package->dimensions }}</p>
                                    <p class="col-2 p-2"><strong>Weight:</strong> {{ $package->weight }}</p>
                                    <p class="col-5 p-2"><strong>Delivery Address:</strong>
                                        {{ $package->full_customer_address }}</p>
                                    @if (Auth::user()->role == 'employee')
                                        @if ($package->labelID == null)
                                            <div class="col-4 p-2">
                                                <form action="{{ route('saveLabel') }}" method="post">
                                                    @csrf
                                                    <select class="form-control d-inline-block w-25" name="deliverer">
                                                        <option value="DHL">DHL</option>
                                                        <option value="PostNL">PostNL</option>
                                                        <option value="DPD">DPD</option>
                                                        <option value="UPS">UPS</option>
                                                    </select>
                                                    <input type="number" value="{{ $package->id }}" name="packageID"
                                                        hidden>
                                                    <input type="submit" class="btn btn-secondary mb-1"
                                                        value="Create Label">
                                                </form>

                                            </div>
                                        @else
                                            <div class="col-4 p-2">
                                                @php
                                                    $temp = false;
                                                @endphp
                                                @foreach ($pickups as $pickup)
                                                    @if ($pickup->packageID == $package->id)
                                                        @php
                                                            $temp = true;
                                                        @endphp
                                                        <p class="d-inline-block">Pickup planned!</p>
                                                    @endif
                                                @endforeach
                                                @if (!$temp)
                                                    <p class="mt-2">Label Created!</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            @endforeach
                            <hr>
                            <div class="pagination">
                                {{ $packages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
