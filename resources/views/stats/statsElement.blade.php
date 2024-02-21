<div class="list-group mb-5">
    <div class="list-group-item">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <h6>{{ __('Civil servants') }}</h6>
            </div>
            <div class="col">
                <h6>{{ __('Workers') }}</h6>
            </div>
            <div class="col">
                <h6>{{ __('Total staff') }}</h6>
            </div>
        </div>
    </div>

    <div class="list-group-item">
        <div class="row">
            <div class="col">
                <h6>{{ __('Headcount') }}</h6>
            </div>
            @include('stats.statsColumns', ['civilServants' => $stat->totalCivilServants, 'workers' => $stat->totalWorkers, 'genders' => $genders])
        </div>
    </div>
    <div class="list-group-item text-center">
        <b>{{ __('Illness') }}</b>
        <p class="text-muted mb-1">{{ __('missed working days') }}</p>
    </div>
    <div class="list-group-item">
        <div class="row">
            <div class="col">
                <h6 class="mb-0">{{ __('Shorttime') }}</h6>
                <p class="text-muted">{{ __('up to 3 workdays') }}</p>
            </div>
            @include('stats.statsColumns', ['civilServants' => $stat->shortTimeSickCivilServant, 'workers' => $stat->shortTimeSickWorker, 'genders' => $genders])
        </div>
    </div>
    <div class="list-group-item">
        <div class="row">
            <div class="col">
                <h6 class="mb-0">{{ __('Longtime') }}</h6>
                <p class="text-muted">{{ __('over 6 weeks') }}</p>
            </div>
            @include('stats.statsColumns', ['civilServants' => $stat->longTimeSickCivilServant, 'workers' => $stat->longTimeSickWorker, 'genders' => $genders])
        </div>
    </div>
    <div class="list-group-item">
        <div class="row">
            <div class="col">
                <h6 class="mb-0">{{ __('Miscellaneous') }}</h6>
                <p class="text-muted">{{ __('4 workdays to 6 weeks') }}</p>
            </div>
            @include('stats.statsColumns', ['civilServants' => $stat->middleTimeSickCivilServant, 'workers' => $stat->middleTimeSickWorker, 'genders' => $genders])
        </div>
    </div>
</div>
