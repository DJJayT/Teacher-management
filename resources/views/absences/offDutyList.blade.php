<ul class="list-group mb-2">
    @if($offDutyDays->isEmpty())
        <li class="list-group-item">
            {{ __('No off duty days found') }}
        </li>
    @else
        @foreach($offDutyDays as $offDutyDay)
            <li class="list-group-item d-flex justify-content-between">
                <div class="offDutyDayInfos">
                    @if(isset($offDutyDay->teaching_days))
                        <span class="badge bg-primary">
                                {{ __('Teaching days: :days', ['days' => $offDutyDay->teaching_days]) }}
                            </span>
                    @endif
                    <p class="m-0 dates">
                        {{ $offDutyDay->from->format("d.m.Y")}} -
                        @if($offDutyDay->until != null)
                            {{$offDutyDay->until->format("d.m.Y")}}
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
                <div class="offDutyDayActions">
                    <button type="button" class="btn btn-primary editOffDutyDayButton my-1" data-modalId="13"
                            data-offDutyDayId="{{ $offDutyDay->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-danger deleteOffDutyDayButton my-1" data-modalId="1"
                            data-offDutyDayId="{{ $offDutyDay->id }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </li>
        @endforeach
    @endif
</ul>

<div class="offDutyDaysPagination">
    {{ $offDutyDays->links() }}
</div>
