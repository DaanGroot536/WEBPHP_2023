@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPackages') }}">{{ __('ui.packages') }}</a> -> {{ __('ui.create_package') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPackages') }}">{{ __('ui.packages') }}</a> -> {{ __('ui.create_package') }}
                    </div>
                @endif
                <div class="w-75 mx-auto my-5">
                    <form action="{{ route('createPackage') }}" method="post">
                        @csrf
                        <label>{{ __('ui.dimensions') }}</label>
                        <input class="form-control mt-1" type="number" min="0" max="200" name="width"
                            placeholder="{{ __('ui.width') }}">
                        <input class="form-control mt-1" type="number" min="0" max="200" name="length"
                            placeholder="{{ __('ui.length') }}">
                        <input class="form-control mt-1" type="number" min="0" max="200" name="height"
                            placeholder="{{ __('ui.height') }}">
                        <br>
                        <label>{{ __('ui.weight_in_grams') }}</label>
                        <input class="form-control" type="number" min="0" max="40000" name="weight"
                            placeholder="{{ __('ui.weight') }}">
                        <hr>
                        <label>{{ __('ui.customer_email') }}</label>
                        <input class="form-control" type="email" name="customerEmail" placeholder="{{ __('ui.customer_email') }}">
                        <br>
                        <label>{{ __('ui.customer_street') }}</label>
                        <input class="form-control" type="text" name="customerStreet" placeholder="{{ __('ui.customer_street') }}">
                        <br>
                        <label>{{ __('ui.customer_house_nr') }}</label>
                        <input class="form-control" type="number" name="customerHousenumber"
                            placeholder="{{ __('ui.customer_house_nr') }}">
                        <br>
                        <label>{{ __('ui.customer_zip') }}</label>
                        <input class="form-control" type="text" name="customerZipcode" placeholder="{{ __('ui.customer_zip') }}">
                        <br>
                        <label>{{ __('ui.customer_city') }}</label>
                        <input class="form-control" type="text" name="customerCity" placeholder="{{ __('ui.customer_city') }}">
                        <br>
                        <br>
                        <input type="text" name="api_token" value="{{ Auth::user()->api_token }}" hidden>
                        <input type="submit" value="{{ __('ui.save') }}" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
