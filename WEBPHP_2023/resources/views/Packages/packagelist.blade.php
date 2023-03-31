@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.packages') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.packages') }}
                    </div>
                @endif
                <div class="card-body">
                    @if (Auth::user()->role == 'webshop')
                        <a href="{{ route('getCreatePackageView') }}" class="btn btn-success">{{ __('ui.create_package') }} +</a>
                        <a href="{{ route('getBulkImportView') }}" class="btn btn-success">{{ __('ui.bulk_import') }}</a>
                    @endif
                    @if (Auth::user()->role == 'employee')
                        <div class="row">
                            <p>{{ __('ui.bulk_package_instructions') }}</p>
                        </div>
                    @endif
                    <div class="row mx-3">
                        <div class="col-3">
                            <form class="" action="{{ route('getPackages') }}" method="GET">
                                <label for="sort_field">{{ __('ui.sort_by') }}:</label>
                                <div class="row">
                                    <div class="col-8">
                                        <select class="form-control" name="sort_field" id="sort_field">
                                            <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>{{ __('ui.id_sort') }}</option>
                                            <option value="idreversed" {{ $sortField == 'idreversed' ? 'selected' : '' }}>
                                                {{ __('ui.id_sort_reversed') }}
                                            </option>
                                            <option value="status" {{ $sortField == 'status' ? 'selected' : '' }}>
                                                {{ __('ui.status_sort') }}
                                            </option>
                                            <option value="statusreversed"
                                                {{ $sortField == 'statusreversed' ? 'selected' : '' }}>
                                                {{ __('ui.status_sort_reversed') }}
                                            </option>
                                            <option value="weight" {{ $sortField == 'weight' ? 'selected' : '' }}>
                                                {{ __('ui.weight_sort') }}
                                            </option>
                                            <option value="weightreversed"
                                                {{ $sortField == 'weightreversed' ? 'selected' : '' }}>
                                                {{ __('ui.weight_sort_reversed') }}
                                            </option>
                                            <option value="customerCity"
                                                {{ $sortField == 'customerCity' ? 'selected' : '' }}>
                                                {{ __('ui.city_sort') }}
                                            </option>
                                            <option value="customerCityreversed"
                                                {{ $sortField == 'customerCityreversed' ? 'selected' : '' }}>
                                                {{ __('ui.city_sort_reversed') }}
                                            </option>
                                        </select>
                                        <input type="text" name="formused" value="true" hidden>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-primary" type="submit">{{ __('ui.sort') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-5">
                            <form class="" method="GET" action="{{ route('getPackages') }}">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="status">{{ __('ui.status') }}:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">-- {{ __('ui.status_select') }} --</option>
                                            @foreach ($statuses as $id => $description)
                                                <option value="{{ $description }}"
                                                    @if (strtolower($description) === strtolower(request('status'))) selected @endif>
                                                    {{ strtolower($description) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label for="city">{{ __('ui.city') }}:</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="">-- {{ __('ui.city_select') }} --</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city }}"
                                                    @if ($city === request('city')) selected @endif>{{ $city }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary mt-4" type="submit">{{ __('ui.filter') }}</button>
                                    </div>
                                </div>
                                <input type="text" name="formused" value="true" hidden>
                            </form>
                        </div>

                        <div class="col-3">
                            <form>
                                <label>{{ __('ui.search') }}:</label>

                                <div class="row">
                                    <div class="col-8">
                                        <input class="form-control" type="text" placeholder="FullText Search">
                                    </div>
                                    <div class="col-2">
                                        <input class="btn btn-primary" type="submit" value="{{ __('ui.search') }}">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-1">
                            <form class="" action="{{ route('resetFilters') }}" method="GET">
                                <input type="hidden" name="reset" value="1">
                                <button class="btn btn-primary mt-4" type="submit">{{ __('ui.reset') }}</button>
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
                                <strong class="col-1"><strong>{{ __('ui.id') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.status') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.dimensions') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.weight') }}:</strong></strong>
                                <strong class="col-5">{{ __('ui.delivery_address') }}:</strong>
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
                                                        <p class="d-inline-block">{{ __('ui.pickup_planned_msg') }}</p>
                                                    @endif
                                                @endforeach
                                                @if (!$temp)
                                                    <p class="mt-2">{{ __('ui.label_created_msg') }}</p>
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
