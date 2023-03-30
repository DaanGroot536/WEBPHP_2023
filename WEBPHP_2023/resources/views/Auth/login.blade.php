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
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body w-75 justify-content-center mx-auto mt-3">
        <div class="row">
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="LoginAdmin" class="btn btn-secondary">
                <input type="text" value="admin@admin.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="LoginWebshop" class="btn btn-secondary">
                <input type="text" value="sport@world.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="LoginEmployee" class="btn btn-secondary">
                <input type="text" value="emp@emp.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="LoginCustomer" class="btn btn-secondary">
                <input type="text" value="cust@cust.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
            <form action="{{route('authenticate')}}" method="post" class="col">
                @csrf
                <input type="submit" value="loginDeliverer" class="btn btn-secondary">
                <input type="text" value="del@del.com" name="email" hidden>
                <input type="text" value="password" name="password" hidden>
            </form>
        </div>
    </div>

@endsection
