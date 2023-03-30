@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                            Dashboard</a> -> User list
                    </div>
                @else
                    <div class="card-header"><a class="link"
                                                href="{{route('dashboard')}}">{{Auth::user()->name}}
                            Dashboard</a> -> User list
                    </div>
                @endif
                <div class="card-body">
                    <a href="{{route('getCreateUserView')}}" class="btn btn-success">Create User +</a>
                </div>
                <div class="p-3 m-3 list-box">
                    <p class="ml-3">User List:</p>
                    <hr>
                    @foreach($users as $user)
                        <a class="link" href="{{route('getEditUserView', [$user->id])}}">
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
