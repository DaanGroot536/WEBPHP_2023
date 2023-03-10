@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> UserList
                </div>
                <div class="card-body">
                    <a href="{{route('createUser')}}" class="btn btn-success">Create User +</a>
                </div>
                <div class="p-3 m-3 list-box">
                    <p class="ml-3">User List:</p>
                    <hr>
                    @foreach($users as $user)
                        <a class="link" href="{{route('editUser', [$user->id])}}">
                        <div class="my-1 row mx-3 list-item">
                            <p class="col-3 p-3">Username: {{$user->name}}</p>
                            <p class="col-3 p-3">UserRole: {{$user->role}}</p>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
