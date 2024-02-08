<ul class="list-group mt-5 mb-2">
    @foreach($trainings as $training)
        <li class="list-group-item d-flex justify-content-between">
            <div class="trainingInfos">
                <p class="m-0 name">
                    <b>{{ __('Title') }}: {{ $training->title }}</b>
                </p>
                <p class="text-muted m-0">
                    {{ __('Area') }}: {{ $training->area->description }}
                </p>
                <p class="text-muted m-0 mb-2">
                    {{ __('Provider') }}: {{ $training->provider->name }}
                </p>
            </div>
            <div class="managingButtons ms-2">
                <button type="button" class="btn btn-primary editTrainingButton"
                        data-modalId="7" data-trainingId="{{ $training->id }}">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </div>
        </li>
    @endforeach
</ul>


