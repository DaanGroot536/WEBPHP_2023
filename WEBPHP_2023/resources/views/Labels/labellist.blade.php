@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.label_list') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.label_list') }}
                    </div>
                @endif
                <div class="card-body">
                    @foreach ($packages as $package)
                        @if ($package->labelID != null)
                            <div class="row mx-3 list-item">
                                <p class="col-1 p-3">{{ __('ui.id') }}: {{ $package->id }}</p>
                                <p class="col-2 p-3">{{ __('ui.status') }}: {{ __('ui.status_' . strtolower($package->status)) }}</p>
                                <p class="col-2 p-3">{{ __('ui.dimensions') }}: {{ $package->dimensions }}</p>
                                <p class="col-2 p-3">{{ __('ui.gewicht') }}: {{ $package->weight }}</p>
                                <div class="col-2 p-2">
                                    <a class="btn btn-secondary">{{ __('ui.label_print') }}</a>
                                </div>
                        @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
