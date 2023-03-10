@extends('auth.layouts')

@section('content')

    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> <a class="link" href="{{route('getUsers')}}">UserList</a> -> Create User
                </div>
                <div class="w-75 mx-auto my-5">
                    <form action="{{route('update')}}" method="post">
                        @csrf
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="{{$user->name}}">
                        <br>
                        <label>E-mail address</label>
                        <input class="form-control" type="email" name="email" value="{{$user->email}}">
                        <br>
                        <label>New Password</label>
                        <input class="form-control" type="text" name="password" value="password">
                        <br>
                        <label>User Role</label>
                        <input type="number" name="id" value="{{$user->id}}" hidden>
                        <select class="form-control" name="role">
                            <option value="{{$user->role}}">{{$user->role}}</option>
                            @foreach($roles as $role)
                                @if($role != $user->role)
                                    <option value="{{$role->type}}">{{$role->type}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input type="submit" value="Save" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
