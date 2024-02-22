<ul class="list-group mt-5 mb-2">
    @foreach($teachers as $teacher)
        <li class="list-group-item d-flex flex-column flex-lg-row justify-content-between">
            <div class="teacherInfos">
                <p class="m-0 name">
                    {{ $teacher->lastname }}, {{ $teacher->firstname }}
                    ({{ $teacher->abbreviation }}) - {{ $teacher->jobTitle->name }}
                </p>
                @if($teacher->exit != null)
                    <div class="badge bg-danger">
                        {{ __('Left at :date', ['date' => $teacher->exit->format('d.m.Y')]) }}
                    </div>
                @endif
                <p class="text-muted">
                    {{ $teacher->status->name }}
                </p>
                @if($teacher->exit == null)
                    <p @class([
                            'mb-0',
                            'text-warning' => $teacher->getAssessmentDeadline()->clone()->subYear()->isPast(),
                            'text-danger' => $teacher->getAssessmentDeadline()->clone()->subMonthsNoOverflow(6)->isPast()
                        ])>
                        {{ __('Next assessment at :Date', ['Date' => $teacher->getAssessmentDeadline()->format('d.m.Y')]) }}
                    </p>
                @endif
            </div>
            <div class="managingButtons">
                <a href="{{ route('teacher.trainings', ['id' => $teacher->id]) }}" class="btn btn-info my-1">
                    <i class="bi bi-clipboard-check"></i> {{ __('Trainings') }}
                </a>
                <a href="{{ route('teacher.absences', ['id' => $teacher->id]) }}" class="btn btn-info my-1">
                    <i class="bi bi-clock"></i> {{ __('Absences') }}
                </a>
                <button type="button" class="btn btn-primary editTeacherButton my-1"
                        data-modalId="2" data-teacherId="{{ $teacher->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </div>
        </li>
    @endforeach
</ul>

{{ $teachers->links('layouts.navigation') }}
