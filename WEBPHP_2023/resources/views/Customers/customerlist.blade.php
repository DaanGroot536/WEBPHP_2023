@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('customer.dashboard') }}</a> -> {{ __('ui.customers') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.customers') }}
                    </div>
                @endif
                <br>
                <div class="row mx-3">
                    <div class="col-3">
                        <form class="" action="{{ route('getCustomerView') }}" method="GET">
                            <label for="sort_field">{{ __('ui.sort_by') }}:</label>
                            <div class="row">
                                <div class="col-8">
                                    <select class="form-control" name="sort_field" id="sort_field">
                                        <option value="customerName" {{ $sortField == 'name' ? 'selected' : '' }}>
                                            {{ __('ui.name_sort') }}
                                        </option>
                                        <option value="customerNamereversed"
                                            {{ $sortField == 'namereversed' ? 'selected' : '' }}>
                                            {{ __('ui.name_sort_reversed') }}
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

                    <div class="col-4">
                        <form class="" method="GET" action="{{ route('getCustomerView') }}">
                            <div class="row">
                                <div class="col-8">
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

                    <div class="col-1">
                        <form class="" action="{{ route('resetCustomerFilters') }}" method="GET">
                            <input type="hidden" name="reset" value="1">
                            <button class="btn btn-primary mt-4" type="submit">{{ __('ui.reset') }}</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="p-3 m-3 list-box">
                    @if (Auth::user()->role == 'webshop')
                        <p class="ml-3">{{ Auth::user()->name }} {{ __('ui.customers') }}:</p>
                    @else
                        <p class="ml-3">{{ Auth::user()->company }} {{ __('ui.customers') }}:</p>
                    @endif
                    <hr>
                    <div class="row mx-3">
                        <strong class="col-3 p-3">{{ __('ui.user_name') }}:</strong>
                        <strong class="col-3 p-3">{{ __('ui.email') }}:</strong>
                        <strong class="col-3 p-3">{{ __('ui.address') }}:</strong>
                    </div>
                    @foreach ($packages as $package)
                            <div class="my-1 row mx-3 list-item">
                                <p class="col-3 p-3">{{ $package->customerName }}</p>
                                <p class="col-3 p-3">{{ $package->customerEmail }}</p>
                                <p class="col-3 p-3">{{ $package->customerStreet }} {{ $package->customerHousenumber }}
                                    {{ $package->customerCity }}</p>
                            </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
