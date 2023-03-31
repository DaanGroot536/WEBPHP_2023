@extends('auth.layouts')

@section('content')

    <head>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getUserView') }}">{{ __('ui.users') }}</a> -> {{ __('ui.edit_user') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getUserView') }}">{{ __('ui.users') }}</a> -> {{ __('ui.edit_user') }}
                    </div>
                @endif
                <div class="w-75 mx-auto my-5">
                    <form action="{{ route('updateUser') }}" method="post">
                        @csrf
                        <label>{{ __('auth.name') }}</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                        <br>
                        <label>{{ __('auth.email_address') }}</label>
                        <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                        <br>
                        <label>{{ __('auth.new_password') }}</label>
                        <input class="form-control" type="text" name="password" value="password">
                        <br>
                        <label>{{ __('ui.user_role') }}</label>
                        <input type="number" name="id" value="{{ $user->id }}" hidden>
                        <select class="form-control" name="role">
                            <option value="{{ $user->role }}">{{ $user->role }}</option>
                            @foreach ($roles as $role)
                                @if ($role != $user->role)
                                    <option value="{{ $role->type }}">{{ __('ui.role_' . $role->type) }}</option>
                                @endif
                            @endforeach
                        </select>
                        <hr>
                        <label>{{ __('auth.street') }}</label>
                        <input class="form-control" type="text" name="street" value="{{ $user->street }}">
                        <br>
                        <label>{{ __('auth.house_nr') }}</label>
                        <input class="form-control" type="number" name="housenumber" value="{{ $user->housenumber }}">
                        <br>
                        <label>{{ __('auth.zip') }}</label>
                        <input class="form-control" type="text" name="zipcode" value="{{ $user->zipcode }}">
                        <br>
                        <label>{{ __('auth.city') }}</label>
                        <input class="form-control" type="text" name="city" value="{{ $user->city }}">
                        <br>
                        <input type="submit" value="{{ __('ui.save') }}" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
