@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">
            @if (session('error'))
                <div class="alert alert-danger">{{ trans(session('error')) }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <p class="ml-3">{{ __('ui.track_and_trace') }}</p>
                </div>

                <div class="card-body">
                    <div class="p-3 list-box col-10 mb-3 mx-auto">
                        <form action="{{ route('getOrderView') }}" method="post">
                            @csrf
                            <label class="mb-1">{{ __('ui.track_and_trace_instructions') }}</label>
                            <input class="form-control" name="code" type="text"
                                placeholder="{{ __('ui.track_and_trace_code') }}">
                            <input class="btn btn-secondary mt-3" type="submit"
                                value="{{ __('ui.track_and_trace_button') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
