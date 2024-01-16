@extends('layouts.sidebar')

@section('extra-content')

    <h1>{{ __('View Visited Trainings') }}</h1>
    <br>
    <div class="container">
        <div class="row ">
            <div class="col">
                <p class="m-0">{{ __('Teacher') }}:</p>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('new Training entry') }}</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>{{ __('History') }}:</p>
            </div>
            <div class="col">
                <input type="text" id="fname" name="fname">
            </div>
            <div class="col">
                <button type="button" class="btn btn-secondary">{{ __('Search') }}</button>
            </div>
        </div>
    </div>


@endsection
