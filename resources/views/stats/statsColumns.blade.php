@foreach($genders as $gender)
    <td>
        {{ $civilServants->get($gender->id) ?? 0 }}
    </td>
@endforeach
<td>
    {{ $civilServants->get('total') ?? 0 }}
</td>

@foreach($genders as $gender)
    <td>
        {{ $workers->get($gender->id) ?? 0 }}
    </td>
@endforeach
<td>
    {{ $workers->get('total') ?? 0 }}
</td>

@foreach($genders as $gender)
    <td>
        @php
            $totalWorkers = $workers->get($gender->id) ?? 0;
            $totalCivilServants = $civilServants->get($gender->id) ?? 0;
            $total = $totalWorkers + $totalCivilServants;
        @endphp
        {{ $total }}
    </td>
@endforeach
<td>
    @php
        $totalWorkers = $workers->get('total') ?? 0;
        $totalCivilServants = $civilServants->get('total') ?? 0;
        $total = $totalWorkers + $totalCivilServants;
    @endphp
    {{ $total }}
</td>
