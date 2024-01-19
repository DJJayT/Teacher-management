@extends('layouts.sidebar')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/SickDaysOverview.css') }}">
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css"/>
@endsection
@section('title')
    {{ __('Sick Days') }}
@endsection
@section('extra-content')
    <h1>Fehlzeiten - {{$teacher->getName()}}</h1>

    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <input id='calendar'/>
    <p id="selected-p"></p>

    <script>
        jSuites.calendar(document.getElementById('calendar'), {
            type: 'year-month-picker',
            format: 'MMM-YYYY',
            validRange: ['2000-01-01', '2100-12-12'],
            readonly: false,

            onchange: function (instance, value) {
                document.getElementById('selected-p').innerText = 'New value is: ' + value;

                let callback;
                const postData = JSON.parse('{"id": "1", "month": "10", "year": "2023"}');

                utilities.postAjax('/sickdaysmonth/1/10/2023', postData, function (response) {
                    $('.sickDayList').html(response);
                });
                console.log(callback);
            }
        });

    </script>
    <div class="row mb-2 sickDayList">
        @include('sickDays.sickDaysList')
    </div>
@endsection
