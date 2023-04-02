@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="">

            <div class="card">
                @if (Auth::user()->role == 'employee' || Auth::user()->role == 'packer')
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->company }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.label_list') }}
                    </div>
                @else
                    <div class="card-header"><a class="link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}
                            {{ __('ui.dashboard') }}</a> -> {{ __('ui.label_list') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="row mx-4">
                        @if (Auth::user()->role == 'employee' || Auth::user()->role == 'packer')
                            <div class="col-2 p-0">
                                <form action="{{route('printLabelBulk')}}" method="post" class="mt-2">
                                    @csrf
                                    <div class=" d-inline-block w-40"></div>
                                    <input type="submit" class="btn btn-secondary mb-1 w-50"
                                           value="Print">
                                    <div class="checklist">
                                        @foreach($packages as $package)
                                            @if($package->labelID != null)

                                                <div class="row">
                                                    <div class="col"></div>
                                                    <div class="checkitem col">
                                                        <input type="checkbox" class="packageCheck"
                                                               name="{{$package->id}}"
                                                               value="true">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="p-3 list-box col-10 mb-3">
                            <p class="ml-3">Label List:</p>
                            <hr>
                            @foreach ($packages as $package)
                                @if ($package->labelID != null)
                                    <div class="row mx-3 list-item">
                                        <p class="col-1 p-3">{{ __('ui.id') }}: {{ $package->id }}</p>
                                        <p class="col-2 p-3">{{ __('ui.status') }}
                                            : {{ __('ui.status_' . strtolower($package->status)) }}</p>
                                        <p class="col-2 p-3">{{ __('ui.dimensions') }}: {{ $package->dimensions }}</p>
                                        <p class="col-2 p-3">{{ __('ui.weight') }}: {{ $package->weight }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
