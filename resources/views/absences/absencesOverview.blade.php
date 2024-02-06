@extends('layouts.sidebar')
@section('extra-css')
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css"/>
@endsection
@section('title')
    {{ __('Absences overview') }}
@endsection
@section('extra-js')
    <script src="{{ asset('js/absencesOverview.js') }}"></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>
@endsection
@section('extra-content')
    <meta name="teacher_id" content="{{ $teacher->id }}">
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('Absences from :teacher', ['teacher' => $teacher->getName()]) }}</h2>
            <div class="d-flex justify-content-center mb-2">

            </div>
            @include('alerts.default')
        </div>
    </div>

    <label class="form-label" for='calendar'>{{ __('Calendar') }}</label>
    <input class="form-control w-25" id='calendar'>
    <p id="selected-p"></p>

    <div class="row">
        @include('absences.absencesList')
    </div>
@endsection
