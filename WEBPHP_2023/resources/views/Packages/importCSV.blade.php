@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="w-50">
        <div class="card">
            <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                    Dashboard</a> -> <a class="link" href="{{route('getPackages')}}">PackageList</a> -> Create Package
            </div>
            <div class="w-75 mx-auto my-5">
                <form action="{{ route('bulkImportCSV') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="csv_file" id="csv_file">
                    <br>
                    <br>
                    <button type="submit" class="btn btn-success">Import</button>
                    <a href="{{ route('downloadCSVTemplate') }}" class="btn btn-secondary float-right">Download CSV template</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection