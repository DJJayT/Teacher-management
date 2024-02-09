<form action="{{ $route }}" method="post" id="sickDayForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="from" class="form-label">{{ __('From') }} (*)</label>
            <input type="date" class="form-control" name="from" id="from"
                   @if(isset($sickDay))
                       value="{{ $sickDay->from->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="until" class="form-label">{{ __('Until') }} (*)</label>
            <input type="date" class="form-control" name="until" id="until"
                   @if(isset($sickDay))
                       value="{{ $sickDay->until->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="teaching_days" class="form-label">{{ __('Teaching days') }}</label>
            <input type="number" class="form-control" name="teaching_days" id="teaching_days"
                   @if(isset($sickDay))
                       value="{{ $sickDay->teaching_days }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="total_days" class="form-label">{{ __('Total days') }}</label>
            <input type="number" class="form-control" name="total_days" id="total_days"
                   @if(isset($sickDay))
                       value="{{ $sickDay->total_days }}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="reason_type_id" class="form-label">{{ __('Reason') }} (*)</label>
            <select class="form-select" name="reason_type_id" id="reason_type_id">
                <option value="0" selected>{{ __('Select a reason') }}</option>
                @foreach($reasons as $reason)
                    <option
                        @if(isset($sickDay) && $sickDay->reason_type_id === $reason->id)
                            selected
                        @endif
                        value="{{ $reason->id }}">{{ $reason->reason }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="certificate" class="form-check-label">{{ __('Certificate') }}</label>
            <input type="checkbox" class="form-check-input ms-1" name="certificate" id="certificate"
            @if(isset($sickDay) && $sickDay->certificate)
                checked
            @endif
            >
            <br>

            <label for="hospital" class="form-check-label">{{ __('Hospital') }}</label>
            <input type="checkbox" class="form-check-input ms-1" name="hospital" id="hospital"
                   @if(isset($sickDay) && $sickDay->hospital)
                       checked
                @endif
            >
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="certificate_from" class="form-label">{{ __('Certificate from') }}</label>
            <input type="date" class="form-control" name="certificate_from" id="certificate_from"
                   @if(isset($sickDay))
                       value="{{ $sickDay->until->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
    </div>
</form>
