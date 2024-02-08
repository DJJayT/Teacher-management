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
            <label for="duration">{{ __('Duration') }} (*)</label>
            <input type="number" class="form-control" name="duration" id="duration"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->duration }}"
                @endif
            >
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="training_from" class="form-label">{{ __('From') }} (*)</label>
            <input type="date" class="form-control" name="training_from" id="training_from"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->training_from->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-md-6 col-sm-12">
            <label for="training_until" class="form-label">{{ __('Until') }} (*)</label>
            <input type="date" class="form-control" name="training_until" id="training_until"
                   @if(isset($teacherTraining))
                       value="{{ $teacherTraining->training_until->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
</form>
