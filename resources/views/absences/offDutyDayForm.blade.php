<form action="{{ $route }}" method="post" id="offDutyDayForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="from" class="form-label">{{ __('From') }} (*)</label>
            <input type="date" class="form-control" name="from" id="from"
                   @if(isset($offDutyDay))
                       value="{{ $offDutyDay->from->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="until" class="form-label">{{ __('Until') }} (*)</label>
            <input type="date" class="form-control" name="until" id="until"
                   @if(isset($offDutyDay))
                       value="{{ $offDutyDay->until->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="teaching_days" class="form-label">{{ __('Teaching days') }}</label>
            <input type="number" class="form-control" name="teaching_days" id="teaching_days"
                   @if(isset($offDutyDay))
                       value="{{ $offDutyDay->teaching_days }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="reason_type_id" class="form-label">{{ __('Reason') }} (*)</label>
            <select class="form-select" name="reason_type_id" id="reason_type_id">
                <option value="0" selected>{{ __('Select a reason') }}</option>
                @foreach($reasons as $reason)
                    <option
                        @if(isset($offDutyDay) && $offDutyDay->reason_type_id === $reason->id)
                            selected
                        @endif
                        value="{{ $reason->id }}">{{ $reason->reason }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
