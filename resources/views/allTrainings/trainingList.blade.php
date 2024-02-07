<ul class="list-group mt-5 mb-2">
    @foreach($trainings as $training)
        <li class="list-group-item d-flex justify-content-between">
            <div class="trainingInfos">
                <p class="m-0 name">
                    {{ $training->title}}
                </p>
                <p class="text-muted">
                    {{ $training->areas->description }} -  {{ $training->providers->name }}
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


