@extends('layouts.sidebar')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/SickDaysOverview.css') }}">
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css"/>
@endsection
@section('title')
    {{ __('Sick Days') }}
@endsection
@section('extra-js')
    <script src="{{ asset('js/sickDayOverview.js') }}"></script>
@endsection
@section('extra-content')
    <h1 class="title" data-teacherid="{{ $teacher->id }}">Fehlzeiten - {{$teacher->getName()}}</h1>

    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <input id='calendar'/>
    <p id="selected-p"></p>
    <div class="row mb-2 sickDayList">
        @include('sickDays.sickDaysList')
    </div>
@endsection
