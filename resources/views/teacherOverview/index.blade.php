@extends('layouts.sidebar')

@section('title')
    {{ __('Home') }}
@endsection

@section('extra-js')
    <script src="{{ asset('js/teachersOverview.js') }}"></script>
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('List of teachers') }}</h2>
            @include('alerts.default')
        </div>
    </div>
    <div class="row mb-2">
        <ul class="list-group mt-5">
            @foreach($teachers as $teacher)
                <li class="list-group-item d-flex justify-content-between">
                    <div class="teacherInfos">
                        <p class="m-0 name">
                            {{ $teacher->jobTitle->name }} {{ $teacher->firstname }} {{ $teacher->lastname }}
                            ({{ $teacher->abbreviation }})
                        </p>
                        <p class="text-muted">
                            {{ $teacher->status->name }}
                        </p>
                        <p @class([
                            'mb-0',
                            'text-warning' => $teacher->getAssessmentDeadline()->clone()->subYear()->isPast(),
                            'text-danger' => $teacher->getAssessmentDeadline()->clone()->subMonthsNoOverflow(6)->isPast()
                        ])>
                            {{ __('Next assessment at :Date', ['Date' => $teacher->getAssessmentDeadline()->format('d.m.Y')]) }}
                        </p>
                    </div>
                    <div class="managingButtons ms-2">
                        <a href="{{ route('teacher.trainings', ['id' => $teacher->id]) }}" class="btn btn-info">
                            <i class="bi bi-clipboard-check"></i> {{ __('Trainings') }}
                        </a>
                        <a href="{{ route('teacher.sickDays', ['id' => $teacher->id]) }}" class="btn btn-info">
                            <i class="bi bi-clock"></i> {{ __('Absences') }}
                        </a>
                        <button type="button" class="btn btn-primary editTeacherButton"
                                data-modalId="2" data-teacherId="{{ $teacher->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button type="button" class="btn btn-danger deleteTeacherButton"
                                data-modalId="1" data-teacherId="{{ $teacher->id }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{ $teachers->links() }}
@endsection
