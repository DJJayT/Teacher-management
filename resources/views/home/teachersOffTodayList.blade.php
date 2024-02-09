@if(empty($offToday))
    <div class="list-group-item">
        {{ __('No teachers are off today') }}
    </div>
@else
    @foreach($offToday as $offDayEntry)
        <div class="list-group-item">
            <p class="m-0 name d-inline-block">
                {{ $offDayEntry->teacher->getName() }}
            </p>
            @if($offDayEntry instanceof \App\Models\TeacherSickTime)
                <span class="badge bg-danger ms-2">{{ __('Sick') }}</span>
            @elseif($offDayEntry instanceof \App\Models\TeacherOffDuty)
                <span class="badge bg-primary ms-2">{{ __('Off duty') }}</span>
            @elseif($offDayEntry instanceof \App\Models\TeacherTraining)
                <span class="badge bg-success ms-2">{{ __('Training') }}</span>
            @endif
            <br>
            <p class="text-muted mb-1">
                {{ __('From :from until :until', ['from' => $offDayEntry->from->format('d.m.Y'), 'until' => $offDayEntry->until->format('d.m.Y')]) }}
            </p>
        </div>
    @endforeach
@endif
