@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Employee/Partner login</div>
                <div class="card-body">
                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
                                Address</label>
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
                                   class="col-md-4 col-form-label text-md-end text-start">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <form action="{{route('loginAdmin')}}" method="post" class="col-2">
                            @csrf
                            <input type="submit" value="LoginAdmin" class="btn btn-secondary">
                            <input type="text" value="admin@admin.com" name="email" hidden>
                            <input type="text" value="password" name="password" hidden>
                        </form>
                        <form action="{{route('loginWebshop')}}" method="post" class="col-2">
                            @csrf
                            <input type="submit" value="LoginWebshop" class="btn btn-secondary">
                            <input type="text" value="web@web.com" name="email" hidden>
                            <input type="text" value="password" name="password" hidden>
                        </form>
                        <form action="{{route('loginEmployee')}}" method="post" class="col-2">
                            @csrf
                            <input type="submit" value="LoginEmployee" class="btn btn-secondary">
                            <input type="text" value="emp@emp.com" name="email" hidden>
                            <input type="text" value="password" name="password" hidden>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
