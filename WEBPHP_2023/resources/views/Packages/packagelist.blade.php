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
                    <div class="row mx-3">
                        <div class="col-4">
                            <form class="" action="{{ route('getPackages') }}" method="GET">
                                <label for="sort_field">Sort by:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-control" name="sort_field" id="sort_field">
                                            <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>ID</option>
                                            <option value="idreversed" {{ $sortField == 'idreversed' ? 'selected' : '' }}>ID - Reversed</option>
                                            <option value="status" {{ $sortField == 'status' ? 'selected' : '' }}>Status</option>
                                            <option value="statusreversed" {{ $sortField == 'statusreversed' ? 'selected' : '' }}>Status - Reversed</option>
                                            <option value="weight" {{ $sortField == 'weight' ? 'selected' : '' }}>Weight</option>
                                            <option value="weightreversed" {{ $sortField == 'weightreversed' ? 'selected' : '' }}>Weight - Reversed</option>
                                            <option value="customerCity" {{ $sortField == 'customerCity' ? 'selected' : '' }}>City</option>
                                            <option value="customerCityreversed" {{ $sortField == 'customerCityreversed' ? 'selected' : '' }}>City - Reversed</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary" type="submit">Sort</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col">
                            <form class="" method="GET" action="{{ route('getPackages') }}">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">-- Select status --</option>
                                            @foreach ($statuses as $id => $description)
                                                <option value="{{ $description }}"
                                                        @if (strtolower($description) === strtolower(request('status'))) selected @endif> {{ strtolower($description) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="city">City:</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="">-- Select city --</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city }}"
                                                        @if ($city === request('city')) selected @endif>{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary mt-4" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-1">
                            <form class="" action="{{ route('resetFilters') }}" method="GET">
                                <input type="hidden" name="reset" value="1">
                                <button class="btn btn-primary mt-4" type="submit">Reset</button>
                            </form>
                        </div>
                    </div>
                    <hr>

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
                        <div class="p-3 list-box col-10 mb-3">

                            <div class="row mx-3">
                                <strong class="col-1"><strong>ID:</strong></strong>
                                <strong class="col-2"><strong>Status:</strong></strong>
                                <strong class="col-2"><strong>dimensions:</strong></strong>
                                <strong class="col-2"><strong>Weight:</strong></strong>
                                <strong class="col-5">Delivery Address:</strong>
                            </div>
                            <hr>
                            @foreach ($packages as $package)
                                <div class="row mx-3 list-item">
                                    <p class="col-1 py-2">{{ $package->id }}</p>
                                    <p class="col-2 py-2">{{ $package->status }}</p>
                                    <p class="col-2 py-2">{{ $package->dimensions }}</p>
                                    <p class="col-2 py-2">{{ $package->weight }}</p>
                                    <p class="col-5 py-2">
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
