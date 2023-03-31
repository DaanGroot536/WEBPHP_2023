@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">

                <div class="card-header">
                    <p class="ml-3">Trackandtrace</p>
                </div>
                <div class="card-body">
                    <div class="p-3 list-box col-10 mb-3 mx-auto">
                        <form action="{{route('getOrderView')}}" method="post">
                            @csrf
                            <label class="mb-1">Enter your code here to track your package or write a review</label>
                            <input class="form-control" name="code" placeholder="your code">
                            <input class="btn btn-secondary mt-3" type="submit" value="Track Order">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
