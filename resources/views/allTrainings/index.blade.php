@extends('layouts.sidebar')

@section('extra-js')
    <script src="{{ asset('js/trainingsOverview.js') }}"></script>
@endsection

@section('extra-content')

    <div class="container">
        <div class="row pt-3 pb-3 ">
            <div class="col me-4">
                <h1>{{ __('All trainings') }}</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-outline-success createTrainingButton" data-modalId="6">
                    <i class="bi bi-plus-circle"></i> {{ __('new training') }}
                </button>
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
                <button type="button" class="btn btn-secondary"><i class="bi bi-search"></i> {{ __('Search') }}</button>
            </div>
        </div>
        <div class="row pt-2 pb-2">
            <table>
                <tr>
                    <th>{{__("Title")}}</th>
                    <th>{{__("area")}}</th>
                    <th>{{__("provider")}}</th>

                    @foreach($trainings as $training)
                        <th>{{ $training->title }}</th>
                        <th>{{ $training->area }}</th>
                        <th>{{ $training->provider }}</th>
                    @endforeach
                </tr>
            </table>
        </div>
        <div class="row mb-2 trainingsOverview">
            @include('allTrainings.trainingList')
        </div>

    </div>


@endsection
