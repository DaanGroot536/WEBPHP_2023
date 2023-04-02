@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.users') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.users') }}
                    </div>
                @endif
                <div class="card-body">
                    <a dusk="createuser" href="{{ route('getCreateUserView') }}" class="btn btn-success">{{ __('ui.create_user') }} +</a>
                </div>
                <div class="p-3 m-3 list-box">
                    <p class="ml-3">{{ __('ui.users') }}:</p>
                    <hr>
                    @foreach ($users as $user)
                        <a dusk="user{{$user->id}}" class="link" href="{{ route('getEditUserView', [$user->id]) }}">
                            <div class="my-1 row mx-3 list-item">
                                <p class="col-3 p-3">{{ __('ui.user_name') }}: {{ $user->name }}</p>
                                <p class="col-3 p-3">{{ __('ui.user_role') }}: {{ __('ui.role_' . $user->role) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
