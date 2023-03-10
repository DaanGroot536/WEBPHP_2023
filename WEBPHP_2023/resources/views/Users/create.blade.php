@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> <a class="link" href="{{route('getUsers')}}">UserList</a> -> Create User
                </div>
                <div class="w-75 mx-auto my-5">
                    <form action="{{route('save')}}" method="post">
                        @csrf
                        <label>Name*</label>
                        <input class="form-control" type="text" name="name" placeholder="name">
                        <br>
                        <label>E-mail address*</label>
                        <input class="form-control" type="email" name="email" placeholder="e-mail address">
                        <br>
                        <label>Password*</label>
                        <input class="form-control" type="text" name="password" placeholder="password">
                        <br>
                        <label>User Role*</label>
                        <select class="form-control" name="role">
                            @foreach($roles as $role)
                                <option value="{{$role->type}}">{{$role->type}}</option>
                            @endforeach
                        </select>
                        <hr>
                        <label>Street</label>
                        <input class="form-control" type="text" name="street" placeholder="street">
                        <br>
                        <label>House nr.</label>
                        <input class="form-control" type="number" name="housenumber" placeholder="housenumber">
                        <br>
                        <label>Zipcode</label>
                        <input class="form-control" type="text" name="zipcode" placeholder="zipcode">
                        <br>
                        <label>City</label>
                        <input class="form-control" type="text" name="city" placeholder="city">
                        <br>
                        <input type="submit" value="Save" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
