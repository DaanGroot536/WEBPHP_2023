@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link" href="{{ route('getUserView') }}">{{ __('ui.users') }}</a>
                        -> {{ __('ui.create_user') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link" href="{{ route('getUserView') }}">{{ __('ui.users') }}</a>
                        -> {{ __('ui.dashboard') }}
                    </div>
                @endif
                <div class="w-75 mx-auto my-5">
                    <form action="{{ route('saveUser') }}" method="post">
                        @csrf
                        <label>{{ __('auth.name') }}*</label>
                        <input class="form-control" type="text" name="name" placeholder="{{ __('auth.name') }}">
                        <br>
                        <label>{{ __('auth.email_address') }}*</label>
                        <input class="form-control" type="email" name="email" placeholder="{{ __('auth.email_address') }}">
                        <br>
                        <label>{{ __('auth.password_verb') }}*</label>
                        <input class="form-control" type="text" name="password" placeholder="{{ __('auth.password_verb') }}">
                        <br>
                        <label>{{ __('ui.user_role') }}*</label>
                        <select class="form-control" name="role">
                            @foreach ($roles as $role)
                                @if (Auth::user()->role == 'webshop')
                                    @if ($role->type == 'employee' || $role->type == 'packer')
                                        <option value="{{ $role->type }}">{{ $role->type }}</option>
                                    @endif
                                @else
                                    <option value="{{ $role->type }}">{{ $role->type }}</option>
                                @endif
                            @endforeach
                        </select>
                        <hr>
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
                        <input type="submit" value="{{ __('ui.save') }}" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
