<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col" colspan="{{ $genders->count() + 1 }}">{{ __('Civil servants') }}</th>
        <th scope="col" colspan="{{ $genders->count() + 1 }}">{{ __('Workers') }}</th>
        <th scope="col" colspan="{{ $genders->count() + 1 }}">{{ __('Total staff') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row"></th>
        @foreach($genders as $gender)
            <td>
                <b>{{ substr($gender->name, 0, 1) }}</b>
            </td>
        @endforeach
        <td>
            <b>{{ __('Sum') }}</b>
        </td>
        @foreach($genders as $gender)
            <td>
                <b>{{ substr($gender->name, 0, 1) }}</b>
            </td>
        @endforeach
        <td>
            <b>{{ __('Sum') }}</b>
        </td>
        @foreach($genders as $gender)
            <td>
                <b>{{ substr($gender->name, 0, 1) }}</b>
            </td>
        @endforeach
        <td>
            <b>{{ __('Sum') }}</b>
        </td>
    </tr>
    <tr>
        <th scope="row">{{ __('Headcount') }}</th>
        @include('stats.statsColumns', ['civilServants' => $stat->totalCivilServants, 'workers' => $stat->totalWorkers, 'genders' => $genders])
    </tr>
    <tr>
        <th class="text-center" scope="row" colspan="{{ $genders->count() * 4 + 1 }}">
            {{ __('Illness') }}
            <p class="text-muted mb-1">{{ __('missed working days') }}</p>
        </th>
    </tr>
    <tr>
        <th scope="row">
            {{ __('Shorttime') }}
            <p class="text-muted mb-1">{{ __('up to 3 workdays') }}</p>
        </th>
        @include('stats.statsColumns', ['civilServants' => $stat->shortTimeSickCivilServant, 'workers' => $stat->shortTimeSickWorker, 'genders' => $genders])
    </tr>
    <tr>
        <th scope="row">
            {{ __('Longtime') }}
            <p class="text-muted mb-1">{{ __('over 6 weeks') }}</p>
        </th>
        @include('stats.statsColumns', ['civilServants' => $stat->longTimeSickCivilServant, 'workers' => $stat->longTimeSickWorker, 'genders' => $genders])
    </tr>
    <tr>
        <th scope="row">
            {{ __('Miscellaneous') }}
            <p class="text-muted mb-1">{{ __('4 workdays to 6 weeks') }}</p>
        </th>
        @include('stats.statsColumns', ['civilServants' => $stat->middleTimeSickCivilServant, 'workers' => $stat->middleTimeSickWorker, 'genders' => $genders])
    </tr>
    </tbody>
</table>
