@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                            Dashboard</a> -> Customer List
                    </div>
                @else
                    <div class="card-header"><a class="link"
                                                href="{{route('dashboard')}}">{{Auth::user()->name}}
                            Dashboard</a> -> Customer List
                    </div>
                @endif
                <br>
                <div class="row mx-3">
                    <div class="col-3">
                        <form class="" action="{{ route('getCustomerView') }}" method="GET">
                            <label for="sort_field">Sort by:</label>
                            <div class="row">
                                <div class="col-8">
                                    <select class="form-control" name="sort_field" id="sort_field">
                                        <option value="customerName" {{ $sortField == 'name' ? 'selected' : '' }}>
                                            Name
                                        </option>
                                        <option
                                            value="customerNamereversed" {{ $sortField == 'namereversed' ? 'selected' : '' }}>
                                            Name - Reversed
                                        </option>
                                        <option
                                            value="customerCity" {{ $sortField == 'customerCity' ? 'selected' : '' }}>
                                            City
                                        </option>
                                        <option
                                            value="customerCityreversed" {{ $sortField == 'customerCityreversed' ? 'selected' : '' }}>
                                            City - Reversed
                                        </option>
                                    </select>
                                    <input type="text" name="formused" value="true" hidden>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary" type="submit">Sort</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-4">
                        <form class="" method="GET" action="{{ route('getCustomerView') }}">
                            <div class="row">
                                <div class="col-8">
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
                            <input type="text" name="formused" value="true" hidden>
                        </form>
                    </div>

                    <div class="col-1">
                        <form class="" action="{{ route('resetCustomerFilters') }}" method="GET">
                            <input type="hidden" name="reset" value="1">
                            <button class="btn btn-primary mt-4" type="submit">Reset</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="p-3 m-3 list-box">
                    @if(Auth::user()->role == 'webshop')
                        <p class="ml-3">{{Auth::user()->name}} Customer List:</p>
                    @else
                        <p class="ml-3">{{Auth::user()->company}} Customer List:</p>
                    @endif
                    <hr>
                    <div class="row mx-3">
                        <p class="col-3 p-3">Username:</p>
                        <p class="col-3 p-3">Email:</p>
                        <p class="col-3 p-3">Address:</p>
                    </div>
                    @foreach($packages as $package)
                            <a class="link" href="">
                                <div class="my-1 row mx-3 list-item">
                                    <p class="col-3 p-3">{{$package->customerName}}</p>
                                    <p class="col-3 p-3">{{$package->customerEmail}}</p>
                                    <p class="col-3 p-3">{{$package->customerStreet}} {{$package->customerHousenumber}} {{$package->customerCity}}</p>
                                </div>
                            </a>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
