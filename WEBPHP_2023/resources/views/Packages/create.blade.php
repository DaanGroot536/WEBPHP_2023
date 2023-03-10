@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->role}}
                        Dashboard</a> -> <a class="link" href="{{route('getPackages')}}">PackageList</a> -> Create Package
                </div>
                <div class="w-75 mx-auto my-5">
                    <form action="{{route('savePackage')}}" method="post">
                        @csrf
                        <label>Dimensions</label>
                        <input class="form-control mt-1" type="number" min="0" max="200" name="width" placeholder="width">
                        <input class="form-control mt-1" type="number" min="0" max="200" name="length" placeholder="length">
                        <input class="form-control mt-1" type="number" min="0" max="200" name="height" placeholder="height">
                        <br>
                        <label>Weight in grams</label>
                        <input class="form-control" type="number" min="0" max="40000" name="weight" placeholder="weight">
                        <hr>
                        <label>Customer Street</label>
                        <input class="form-control" type="text" name="customerStreet" placeholder="customerStreet">
                        <br>
                        <label>Customer House nr.</label>
                        <input class="form-control" type="number" name="customerHousenumber" placeholder="customerHousenumber">
                        <br>
                        <label>Customer Zipcode</label>
                        <input class="form-control" type="text" name="customerZipcode" placeholder="customerZipcode">
                        <br>
                        <label>Customer City</label>
                        <input class="form-control" type="text" name="customerCity" placeholder="customerCity">
                        <br>
                        <br>
                        <input type="submit" value="Save" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
