<ul class="list-group mb-2">
    @if($sickDays->isEmpty())
        <li class="list-group-item">
            {{ __('No sick days found') }}
        </li>
    @else
        @foreach($sickDays as $sickDay)
            <li class="list-group-item d-flex justify-content-between">
                <div class="sickDayInfos">
                    <p class="m-0 dates d-inline-block">
                        {{ $sickDay->from->format("d.m.Y") }} -
                        @if($sickDay->until != null)
                            {{ $sickDay->until->format("d.m.Y") }}
                        @endif
                    </p>
                    @if(isset($sickDay->teaching_days))
                        <span class="badge bg-primary ms-2">
                                {{ __('Teaching days: :days', ['days' => $sickDay->teaching_days]) }}
                            </span>
                    @endif
                    @if(isset($sickDay->total_days))
                        <span class="badge bg-secondary ms-2">
                                {{ __('Total days: :days', ['days' => $sickDay->total_days]) }}
                            </span>
                    @endif
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
            </li>
        @endforeach
    @endif
</ul>

<div class="sickDaysPagination">
    {{ $sickDays->links() }}
</div>
