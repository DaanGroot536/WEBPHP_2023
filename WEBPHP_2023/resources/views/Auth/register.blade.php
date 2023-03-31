@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.register_customer') }}</div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.email_address') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.password_verb') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.confirm_password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <label>{{ __('auth.street') }}</label>
                        <input class="form-control" type="text" name="street" placeholder="{{ __('auth.street') }}">
                        <br>
                        <label>{{ __('auth.house_nr') }}</label>
                        <input class="form-control" type="number" name="housenumber" placeholder="{{ __('auth.house_nr') }}">
                        <br>
                        <label>{{ __('auth.zip') }}</label>
                        <input class="form-control" type="text" name="zipcode" placeholder="{{ __('auth.zip') }}">
                        <br>
                        <label>{{ __('auth.city') }}</label>
                        <input class="form-control" type="text" name="city" placeholder="{{ __('auth.city') }}">
                        <br>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('auth.register') }}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
