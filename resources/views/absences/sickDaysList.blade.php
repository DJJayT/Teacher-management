<ul class="list-group mb-2">
    @if($sickDays->isEmpty())
        <li class="list-group-item">
            {{ __('No sick days found') }}
        </li>
    @else
        @foreach($sickDays as $sickDay)
            <li class="list-group-item d-flex justify-content-between">
                <div class="sickDayInfos">
                    @if(isset($sickDay->teaching_days))
                        <span class="badge bg-primary">
                                {{ __('Teaching days: :days', ['days' => $sickDay->teaching_days]) }}
                            </span>
                    @endif
                    @if(isset($sickDay->total_days))
                        <span class="badge bg-secondary">
                                {{ __('Total days: :days', ['days' => $sickDay->total_days]) }}
                            </span>
                    @endif
                    <p class="m-0 dates">
                        {{ $sickDay->from->format("d.m.Y") }} -
                        @if($sickDay->until != null)
                            {{ $sickDay->until->format("d.m.Y") }}
                        @endif
                    </p>
                    <p class="text-muted m-0">
                        {{ __('Reason') }}: {{ $sickDay->reason->reason }}
                    </p>
                    <p @class([
                            'mb-0',
                            'text-muted' => !$sickDay->hospital,
                            'text-danger' => $sickDay->hospital
                        ])>
                        @if($sickDay->hospital)
                            {{ __('In hospital') }}
                        @else
                            {{ __('Not in hospital') }}
                        @endif
                    </p>
                    <p @class([
                            'mb-0',
                            'text-success' => $sickDay->certificate,
                            'text-danger' => !$sickDay->certificate
                        ])>
                        @if($sickDay->certificate)
                            {{ __('Excused') }}
                        @else
                            {{ __('Unexcused') }}
                        @endif
                    </p>
                </div>
                <div class="sickDayActions">
                    <button type="button" class="btn btn-primary editSickDayButton" data-modalId="11"
                            data-sickDayId="{{ $sickDay->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-danger deleteSickDayButton" data-modalId="1"
                            data-sickDayId="{{ $sickDay->id }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </li>
        @endforeach
    @endif
</ul>

<div class="sickDaysPagination">
    {{ $sickDays->links() }}
</div>
