@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="card">
        <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                Dashboard</a> -> PackageList
        </div>
        <div class="card-body">
            @if (Auth::user()->role == 'webshop')
            <a href="{{route('getCreatePackageView')}}" class="btn btn-success">Create Package +</a>
            <a href="{{route('getBulkImportView')}}" class="btn btn-success">Bulk Import</a>
            @endif

        </div>
        <div class="p-3 m-3 list-box">
            <p class="ml-3">Package List:</p>
            <hr>
            @foreach($packages as $package)
            <div class="my-2 row mx-3 list-item">
                <p class="col-1 p-3">ID: {{$package->id}}</p>
                <p class="col-2 p-3">Status: {{$package->status}}</p>
                <p class="col-2 p-3">dimensions: {{$package->dimensions}}</p>
                <p class="col-2 p-3">Weight: {{$package->weight}}</p>
                @if($package->labelID == null)
                <div class="col-5 p-2">
                    <form action="{{route('saveLabel')}}" method="post">
                        @csrf
                        <select class="form-control d-inline-block w-25" name="deliverer">
                            <option value="DHL">DHL</option>
                            <option value="PostNL">PostNL</option>
                            <option value="DPD">DPD</option>
                            <option value="UPS">UPS</option>
                        </select>
                        <input type="number" value="{{$package->id}}" name="packageID" hidden>
                        <input type="submit" class="btn btn-secondary mb-1 w-25" value="Create Label">
                    </form>
                </div>
                @else
                <div class="col-2 p-2">
                    <a class="btn btn-secondary">Show/Print Label</a>

                </div>
                @endif

            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection