<div class="col-md-6 col-12 mb-2 sickDayList">
    <h4>{{ __('Sick days') }}</h4>
    <button type="button" class="btn btn-outline-success createSickDayButton mb-2" data-modalId="10" data-teacherId="{{ $teacher->id }}">
        <i class="bi bi-plus-circle"></i> {{ __('Create new sick day') }}
    </button>
    @include('absences.sickDaysList')
</div>
<div class="col-md-6 col-12 mb-2 offDutyList">
    <h4>{{ __('Off duty days') }}</h4>
    <button type="button" class="btn btn-outline-success createOffDutyButton mb-2" data-modalId="11" data-teacherId="{{ $teacher->id }}">
        <i class="bi bi-plus-circle"></i> {{ __('Create new off duty day') }}
    </button>
    @include('absences.offDutyList')
</div>
