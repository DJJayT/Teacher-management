<ul class="list-group mt-5">
    @if($sickDays->isEmpty())
        <li class="list-group-item">
            {{ __('No sick days found') }}
        </li>
    @else
        @foreach($sickDays as $sick)
            <li class="list-group-item d-flex justify-content-between">
                <div class="teacherInfos">
                    <p class="m-0 name">
                        {{ $sick->from->format("d.m.Y")}} -
                        @if($sick->until != null)
                            {{$sick->until->format("d.m.Y")}}
                        @endif
                    </p>
                    <p class="text-muted">
                        {{ __('Reason') }}: {{ $sick->reason->reason }}
                    </p>
                    <p @class([
                            'mb-0',
                            'text-success' => $sick->certificate,
                            'text-danger' => !$sick->certificate
                        ])>
                        @if($sick->certificate)
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
