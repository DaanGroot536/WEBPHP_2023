@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">
            @if (session('error'))
                <div class="alert alert-danger">{{ trans(session('error')) }}</div>
            @endif
            <div class="card">

                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.plan_pickup') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.plan_pickup') }}
                    </div>
                @endif
                <div class="row mx-3 mt-3">
                    <div class="col-3">
                        <form class="" action="{{ route('getPickupView') }}" method="GET">
                            <label for="sort_field">{{ __('ui.sort_by') }}:</label>
                            <div class="row">
                                <div class="col-8">
                                    <select class="form-control" name="sort_field" id="sort_field">
                                        <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>
                                            {{ __('ui.id_sort') }}</option>
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
                                        <option value="customerCity" {{ $sortField == 'customerCity' ? 'selected' : '' }}>
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
                        <form class="" method="GET" action="{{ route('getPickupView') }}">
                            <div class="row">
                                <div class="col-5">
                                    <label for="status">{{ __('ui.status') }}:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">-- {{ __('ui.status_select') }} --</option>
                                        @foreach ($statuses as $id => $description)
                                            <option value="{{ $description }}"
                                                @if (strtolower($description) === strtolower(request('status'))) selected @endif>
                                                {{ __('ui.status_' . strtolower($description)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="city">{{ __('auth.city') }}:</label>
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
                        <form action="{{ route('getPickupView') }}" method="GET">
                            <label>{{ __('ui.search') }}:</label>

                            <div class="row">
                                <div class="col-8">
                                    <input class="form-control" type="text" name="searchtext" required="required"
                                        placeholder="{{ __('ui.search') }}">
                                </div>
                                <div class="col-2">
                                    <input class="btn btn-primary" type="submit" value="{{ __('ui.search') }}">
                                    <input type="text" name="fulltext" value="true" hidden>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-1">
                        <form class="" action="{{ route('resetPickupFilters') }}" method="GET">
                            <input type="hidden" name="reset" value="1">
                            <button class="btn btn-primary mt-4" type="submit">{{ __('ui.reset') }}</button>
                        </form>
                    </div>
                </div>
                <hr>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ __('ui.no_pickup') }}</div>
                    @endif
                    <div class="row mx-4">
                        @if (Auth::user()->role == 'employee')
                            <div class="col-2 p-0">
                                <form action="{{ route('getCreatePickupBulk') }}" method="post" class="mt-2">
                                    @csrf
                                    <div class=" d-inline-block w-40"></div>
                                    <input dusk="planpickup" type="submit" class="btn btn-secondary mb-1 w-50"
                                        value="{{ __('ui.plan') }}">

                                    <div class="checklist">
                                        @foreach ($packages as $package)
                                            @if ($package->pickupID == null)
                                                <div class="row id{{ $package->id }}">
                                                    <div class="col"></div>
                                                    <div class="checkitem col">
                                                        @if ($package->labelID != null)
                                                            <input dusk="check{{ $package->id }}" type="checkbox"
                                                                class="packageCheck" name="{{ $package->id }}"
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
                            <div class="row mx-3">
                                <strong class="col-1"><strong>{{ __('ui.id') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.status') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.dimensions') }}:</strong></strong>
                                <strong class="col-2"><strong>{{ __('ui.weight') }}:</strong></strong>
                                <strong class="col-5">{{ __('ui.delivery_address') }}:</strong>
                            </div>
                            <hr>
                            @foreach ($packages as $package)
                                @if ($package->pickupID == null)
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">{{ $package->id }}</p>
                                        <p class="col-2 p-3">{{ strtolower($package->status) }}</p>
                                        <p class="col-2 p-3">{{ $package->dimensions }}</p>
                                        <p class="col-2 p-3">{{ $package->weight }}</p>
                                        <p class="col-3 p-3">{{ $package->customerStreet }} {{ $package->customerHousenumber }}
                                            {{ $package->customerCity }}</p>
                                        @if (Auth::user()->role == 'employee')
                                            @if ($package->labelID == null)
                                                <p class="col-2 mt-3">{{ __('ui.label_warning') }}</p>
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
