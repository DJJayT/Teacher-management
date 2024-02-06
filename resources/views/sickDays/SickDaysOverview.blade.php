@extends('layouts.sidebar')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/sickDaysOverview.css') }}">
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css"/>
@endsection
@section('title')
    {{ __('Sick Days') }}
@endsection
@section('extra-js')
    <script src="{{ asset('js/sickDayOverview.js') }}"></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>
@endsection
@section('extra-content')
    <meta name="teacher_id" content="{{ $teacher->id }}">
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('Days off from :teacher', ['teacher' => $teacher->getName()]) }}</h2>
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-outline-success createDayOffButton" data-modalId="3">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new day off') }}
                </button>
            </div>
            @include('alerts.default')
        </div>
    </div>

    <input id='calendar'>
    <p id="selected-p"></p>
    <div class="row mb-2 sickDayList">
        @include('sickDays.sickDaysList')
    </div>
@endsection
