@extends('layouts.sidebar')

@section('title')
    {{ __('All trainings') }}
@endsection

@section('extra-js')
    <script src="{{ asset('js/trainingsOverview.js') }}"></script>
@endsection

@section('extra-content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>{{ __('All trainings') }}</h2>
                <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-outline-success createTrainingButton" data-modalId="6">
                        <i class="bi bi-plus-circle"></i> {{ __('Create new training') }}
                    </button>
                </div>
                @include('alerts.default')
            </div>
        </div>
        <div class="row mb-2 trainingsOverview">
            @include('allTrainings.trainingList')

            {{ $trainings->links() }}
        </div>

    </div>


@endsection
