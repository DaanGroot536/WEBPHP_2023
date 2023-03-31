@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('auth.login_header') }}</div>
                <div class="card-body">
                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.email_address') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end text-start">{{ __('auth.password_verb') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('auth.login') }}">
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body w-75 justify-content-center mx-auto mt-3">
        <div class="row">
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="{{ __('auth.login_admin') }}" class="btn btn-secondary">
                <input type="text" value="admin@admin.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input dusk="loginwebshop" type="submit" value="{{ __('auth.login_webshop') }}" class="btn btn-secondary">
                <input type="text" value="sport@world.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="{{ __('auth.login_employee') }}" class="btn btn-secondary">
                <input type="text" value="emp@emp.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="{{ __('auth.login_customer') }}" class="btn btn-secondary">
                <input type="text" value="cust@cust.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="{{ __('auth.login_deliverer') }}" class="btn btn-secondary">
                <input type="text" value="del@del.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="{{ __('auth.login_packer') }}" class="btn btn-secondary">
                <input type="text" value="emp2@emp2.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
        </div>
    </div>

@endsection
