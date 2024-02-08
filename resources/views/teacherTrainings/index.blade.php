@extends('layouts.sidebar')

@section('title')
    {{ __('Teacher trainings') }}
@endsection

@section('extra-js')
    <script src="{{ asset('js/teacherTrainingsOverview.js') }}"></script>
@endsection

@section('extra-content')
    <meta name="teacher_id" content="{{ $teacher->id }}">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>{{ __('All trainings from :teacher', ['teacher' => $teacher->getName()]) }}</h2>
                <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-outline-success createTeacherTrainingButton"
                            data-modalId="9" data-teacherId="{{ $teacher->id }}">
                        <i class="bi bi-clipboard-check"></i> {{ __('New training entry') }}
                    </button>
                </div>
                @include('alerts.default')
            </div>
        </div>
        <div class="teacherTrainingsOverview">
            @include('teacherTrainings.teacherTrainingsList')
        </div>
    </div>
@endsection
