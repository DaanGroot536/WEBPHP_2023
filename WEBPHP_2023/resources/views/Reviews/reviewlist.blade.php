@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                            Dashboard</a> -> Reviews
                    </div>
                @else
                    <div class="card-header"><a class="link"
                                                href="{{route('dashboard')}}">{{Auth::user()->name}}
                            Dashboard</a> -> Reviews
                    </div>
                @endif
                <div class="card-body">
                    <a href="{{route('getCreateReviewView')}}" class="btn btn-success mb-3">Write review +</a>

                    <div class="p-3 list-box col-10 mb-3">
                        <p class="ml-3">Review List:</p>
                        <hr>
                        @foreach($reviews as $review)
                            <div class="mx-3 list-item">
                                <p>{{$review->username}}</p>
                                <p>{{$review->review_text}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
