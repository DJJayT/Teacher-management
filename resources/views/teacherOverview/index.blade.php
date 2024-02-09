@extends('layouts.sidebar')

@section('title')
    {{ __('Teacher overview') }}
@endsection

@section('extra-js')
    <script src="{{ asset('js/teachersOverview.js') }}"></script>
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('List of teachers') }}</h2>
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-outline-success createTeacherButton" data-modalId="3">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new teacher') }}
                </button>
            </div>
            <button type="button" class="btn btn-success mb-2 showActiveButton">
                <i class="bi bi-check-circle-fill"></i> {{ __('Only show active') }}
            </button>
            @include('alerts.default')
        </div>
    </div>
    <div class="row mb-2 teachersOverview">
        @include('teacherOverview.teacherList')
    </div>
@endsection
