@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPackages') }}">{{ __('ui.packages') }}</a> -> {{ __('ui.create_package') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> <a class="link"
                            href="{{ route('getPackages') }}">{{ __('ui.packages') }}</a> -> {{ __('ui.create_package') }}
                    </div>
                @endif
                <div class="w-75 mx-auto my-5">
                    <form action="{{ route('bulkImportCSV') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" id="csv_file">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success">{{ __('ui.import') }}</button>
                        <a href="{{ route('downloadCSVTemplate') }}" class="btn btn-secondary float-right">{{ __('ui.csv_template') }}</a>
                        <input type="text" name="api_token" value="{{ Auth::user()->api_token }}" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
