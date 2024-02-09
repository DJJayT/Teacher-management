<form action="{{ $route }}" method="post" id="teacherTrainingsForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="training_id">{{ __('Training') }} (*)</label>
            <select class="form-select" name="training_id" id="training_id">
                <option value="0" selected>{{ __('Select a training') }}</option>
                @foreach($trainings as $training)
                    <option
                        @if(isset($teacherTraining) && $teacherTraining->training_id === $training->id)
                            selected
                        @endif
                        value="{{ $training->id }}">{{ $training->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="duration">{{ __('Duration in days') }}
                @if(isset($teacherTraining))
                    - <b>{{ __('Check the count of days') }}</b>
                @endif
            </label>
            <input type="number" class="form-control" name="duration" id="duration"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->duration }}"
                @endif
            >
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="from" class="form-label">{{ __('From') }} (*)</label>
            <input type="date" class="form-control" name="from" id="from"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->from->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="until" class="form-label">{{ __('Until') }} (*)</label>
            <input type="date" class="form-control" name="until" id="until"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->until->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
    </div>
</form>
