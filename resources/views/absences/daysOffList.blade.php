<ul class="list-group">
    @if($offDutyDays->isEmpty())
        <li class="list-group-item">
            {{ __('No sick days found') }}
        </li>
    @else
        @foreach($offDutyDays as $offDutyDay)
            <li class="list-group-item d-flex justify-content-between">
                <div class="teacherInfos">
                    <p class="m-0 dates">
                        {{ $offDutyDay->from->format("d.m.Y")}} -
                        @if($offDutyDay->until != null)
                            {{$offDutyDay->until->format("d.m.Y")}}
                        @endif
                        @if(isset($offDutyDay->teaching_days))
                            <span class="badge bg-primary ms-2">
                                {{ __('Teaching days: :days', ['days' => $offDutyDay->teaching_days]) }}
                            </span>
                        @endif
                    </p>
                    <p class="text-muted">
                        {{ __('Reason') }}: {{ $offDutyDay->reason->reason }}
                    </p>
                    <p @class([
                            'mb-0',
                            'text-success' => $offDutyDay->certificate,
                            'text-danger' => !$offDutyDay->certificate
                        ])>
                    </p>
                </div>
            </li>

        @endforeach
    @endif
</ul>
