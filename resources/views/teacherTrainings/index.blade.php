@extends('layouts.sidebar')

@section('extra-content')

    <div class="container">
        <h1>{{ __('View visited trainings') }}</h1>
        <br>
        <div class="row pt-3 pb-3 ">
            <div class="col">
                <h3 class="m-0">{{ __('Teacher') }}: {{ $teacher->getName() }}</h3>
            </div>
            <div class="col">
                <a href="{{ route('teacher.trainingEntry', ['id' => $teacher->id]) }}" class="btn btn-info">
                    <i class="bi bi-clipboard-check"></i> {{ __('new training entry') }}
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-2">
            <div class="col">
                <p>{{ __('History') }}:</p>
            </div>
            <div class="col">
                <label for="search" class="form-label">{{ __('search') }}:</label>
                <input type="text" class="form-control" name="search" placeholder="{{ __('search term') }}" id="search" >
            </div>
            <div class="col">
                <button type="button" class="btn btn-secondary">{{ __('Search') }}</button>
            </div>
        </div>
        <div class="row pt-2 pb-2">
            <table>
                <tr>
                    <th>Name</th>
                    <th>{{__("from")}}</th>
                    <th>{{__("until")}}</th>
                    <th>{{__("Area")}}</th>
                    <th>{{__("Provider")}}</th>
                    <th>{{__("duration")}}</th>

                    @foreach($trainings as $training)
                    <th>{{ $training->title }}</th>
                    <th>{{ $training->from }}</th>
                    <th>{{ $training->until }}</th>
                    <th>{{ $training->area }}</th>
                    <th>{{ $training->provider }}</th>
                    <th>{{ $training->duration }}</th>
                  @endforeach
                </tr>
            </table>
        </div>

    </div>


@endsection
