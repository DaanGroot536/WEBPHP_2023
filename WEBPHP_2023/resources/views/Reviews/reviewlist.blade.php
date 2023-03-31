@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.reviews') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.reviews') }}
                    </div>
                @endif
                <div class="card-body">
                    <a href="{{ route('getCreateReviewView') }}" class="btn btn-success mb-3">{{ __('ui.review_write') }} +</a>

                    <div class="p-3 list-box col-10 mb-3">
                        <p class="ml-3">{{ __('ui.review_list') }}:</p>
                        <hr>
                        @foreach ($reviews as $review)
                            <div class="mx-3 list-item">
                                <p>{{ $review->username }}</p>
                                <p>{{ $review->review_text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
