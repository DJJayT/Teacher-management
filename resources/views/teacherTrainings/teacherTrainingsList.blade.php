<ul class="list-group mb-2">
    @foreach($trainings as $training)
        <li class="list-group-item d-flex justify-content-between">
            <div class="trainingInfos">
                <p class="m-0 name">
                    <b>{{ __('Title') }}: {{ $training->training->title }}</b>
                </p>
                <p class="text-muted m-0">
                    {{ __('Area') }}: {{ $training->training->area->description }}
                </p>
                <p class="text-muted m-0 mb-2">
                    {{ __('Provider') }}: {{ $training->training->provider->name }}
                </p>
                <p class="text-muted m-0 mb-2">
                    {{ __('From :from until :until',[
                            'from' => $training->training_from->format('d.m.Y'),
                            'until' => $training->training_until->format('d.m.Y')
                            ]) }} - {{ __('Total days: :days', ['days' => $training->duration]) }}
                </p>
            </div>
            <div class="managingButtons ms-2">
                <button type="button" class="btn btn-primary editTeacherTrainingButton"
                        data-modalId="8" data-trainingId="{{ $training->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </div>
        </li>
    @endforeach
</ul>

{{ $trainings->links() }}
