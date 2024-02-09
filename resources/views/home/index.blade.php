@extends('layouts.sidebar')

@section('title')
    {{ __('Home') }}
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('Home') }}</h2>
        </div>
        @include('alerts.default')
    </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-6 col-12 mb-2">
            <h3>{{ __('Teachers off today') }}</h3>
            <div class="list-group">
                @include('home.teachersOffTodayList')
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <h3>{{ __('CIM needed') }}</h3>
            <div class="list-group">
                @if(empty($cimNeeded))
                    <div class="list-group-item">
                        {{ __('No teachers need a CIM') }}
                    </div>
                @else
                    @foreach($cimNeeded as $cimTeacher)
                        <div class="list-group-item">
                            <p class="m-0 name">
                                {{ $cimTeacher->getName() }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
