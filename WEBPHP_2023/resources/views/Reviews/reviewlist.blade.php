@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @guest
                @else
                    @if (Auth::user()->role == 'employee')
                        <div class="card-header"><a class="link" href="{{route('dashboard')}}">{{Auth::user()->company}}
                                {{ __('ui.dashboard') }}</a> -> {{ __('ui.reviews') }}
                        </div>
                    @else
                        <div class="card-header"><a class="link"
                                                    href="{{route('dashboard')}}">{{Auth::user()->name}}
                                {{ __('ui.dashboard') }}</a> -> {{ __('ui.reviews') }}
                        </div>
                    @endif
                @endguest
                <div class="card-body">
                    <div class="p-3 list-box col-10 mb-3">
                        <strong class="ml-3">{{ __('ui.reviews') }}</strong>
                        @foreach($reviews as $review)
                            <div class="mx-3">
                                <p class="">{{$review->username}}</p>
                                <strong>{{$review->amount_of_stars}} {{ __('ui.star_compare') }}</strong>
                                <p class="w-75">{{$review->review_text}}</p>
                                <p>{{ __('ui.delivered_by') }}: {{$review->delivery_service}}</p>
                                <p>{{ __('ui.order_processed_by') }}: {{$review->webshopName}}</p>
                                <p>{{$review->date_of_review}}</p>

                            </div>
                            <hr>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
