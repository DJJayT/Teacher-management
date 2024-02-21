<div class="col">
    @foreach($genders as $gender)
        <p class="mb-0"><b>{{ $gender->name }}:</b> {{ $civilServants->get($gender->id) ?? 0 }}
        </p>
    @endforeach
        <p class="mb-0"><b>Total:</b>
            {{ $civilServants->get('total') ?? 0 }}
        </p>
</div>
<div class="col">
    @foreach($genders as $gender)
        <p class="mb-0"><b>{{ $gender->name }}:</b> {{ $workers->get($gender->id) ?? 0 }} </p>
    @endforeach
        <p class="mb-0"><b>Total:</b>
            {{ $workers->get('total') ?? 0 }}
        </p>
</div>
<div class="col">
    @foreach($genders as $gender)
        <p class="mb-0"><b>{{ $gender->name }}:</b>
            @php
                $totalWorkers = $workers->get($gender->id) ?? 0;
                $totalCivilServants = $civilServants->get($gender->id) ?? 0;
                $total = $totalWorkers + $totalCivilServants;
            @endphp
            {{ $total }}
        </p>
    @endforeach
    <p class="mb-0"><b>Total:</b>
        @php
            $totalWorkers = $workers->get('total') ?? 0;
            $totalCivilServants = $civilServants->get('total') ?? 0;
            $total = $totalWorkers + $totalCivilServants;
        @endphp
        {{ $total }}
    </p>
</div>
