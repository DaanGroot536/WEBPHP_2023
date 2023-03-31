@extends('auth.layouts')

@section('content')
    <div class="card mt-3">
        @if (Auth::user()->role == 'employee')
            <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                    {{ __('ui.dashboard') }}</a> -> {{ __('ui.pickup_calendar') }}
            </div>
        @else
            <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                    {{ __('ui.dashboard') }}</a> -> {{ __('ui.pickup_calendar') }}
            </div>
        @endif
        <div class="card-body vh-100 p-4">
            <div class="row mb-3">
                <form action="{{ route('changeCalendarWeek') }}" method="post" class="col-1">
                    @csrf
                    <input type="text" value="down" name="direction" hidden>
                    <input type="text" value="{{ $date }}" name="date" hidden>
                    <input type="submit" class="btn" value="<">
                </form>
                <div class="col-10"></div>
                <form action="{{ route('changeCalendarWeek') }}" method="post" class="col-1">
                    @csrf
                    <input type="text" value="up" name="direction" hidden>
                    <input type="text" value="{{ $date }}" name="date" hidden>
                    <input type="submit" class="btn rightbtn" value=">">
                </form>
            </div>
            <div class="row calendar">
                @foreach ($days as $day)
                    <div class="col calendar-item text-center mt-1">
                        @if ($day->date == date('Y-m-d'))
                            <p class="strong">{{ $day->dayofweek }}</p>
                            <p>{{ $day->date }}</p>
                        @else
                            <p>{{ $day->dayofweek }}</p>
                            <p>{{ $day->date }}</p>
                        @endif
                        @foreach ($pickups as $pickup)
                            @if ($day->date == date_format(date_create($pickup->pickup_datetime), 'Y-m-d'))
                                <div class="calendar-pickup">
                                    <p>{{ __('ui.package_id') }} {{ $pickup->packageID }}</p>
                                    <p>{{ date_format(date_create($pickup->pickup_datetime), 'H-s') }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
