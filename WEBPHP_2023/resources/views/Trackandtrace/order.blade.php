@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <p class="ml-3">{{ __('ui.order_id') }} {{$package->id}}</p>
                </div>
                <div class="card-body">
                    <div class="p-3 list-box col-10 mb-3 mx-auto">
                        <div class="row mx-3">
                            <strong class="col-1"><strong>{{ __('ui.id') }}:</strong></strong>
                            <strong class="col-2"><strong>{{ __('ui.status') }}:</strong></strong>
                            <strong class="col-2"><strong>{{ __('ui.dimensions') }}:</strong></strong>
                            <strong class="col-2"><strong>{{ __('ui.weight_in_grams') }}:</strong></strong>
                            <strong class="col-5">{{ __('ui.delivery_address') }}:</strong>
                        </div>
                        <div class="row mx-3 list-item">
                            <p class="col-1 py-2">{{ $package->id }}</p>
                            <p class="col-2 py-2">{{ __('ui.status_' . strtolower($package->status)) }}</p>
                            <p class="col-2 py-2">{{ $package->dimensions }}</p>
                            <p class="col-2 py-2">{{ $package->weight }}</p>
                            <p class="col-5 py-2">
                                {{ $package->full_customer_address }}</p>
                        </div>
                        <br>
                        @if ($label != null)
                            <p>{{ __('ui.delivery_service') }}: {{$label->deliverer}}</p>
                        @else
                            <p>{{ __('ui.delivery_service') }}: {{ __('ui.no_delivery_service') }}</p>
                        @endif
                        <hr>
                        @if ($package->status == 'Delivered to customer')
                            <div>
                                <form action="{{route('saveReview')}}" method="post">
                                    @csrf
                                    <label class="mb-1">{{ __('ui.write_review_for') }}{{$package->webshopName}}!</label>
                                    <br>
                                    <label for="amount_of_stars">{{ __('ui.star_amount') }}</label>
                                    <input dusk="stars" class="form-control mb-3 w-25" type="number" min="1" max="5" name="amount_of_stars">
                                    <textarea dusk="reviewtext" class="form-control reviewtext"
                                              name="review_text">{{ __('ui.write_review') }}</textarea>
                                    <input dusk="submit" class="btn btn-secondary mt-3" type="submit" value="Place Review">
                                    <input type="number" name="packageID" value="{{$package->id}}" hidden>
                                    <input type="number" name="labelID" value="{{$label->id}}" hidden>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
