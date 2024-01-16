@extends('layouts.sidebar')

@section('extra-content')

    <div class="container">

        <div class="row pt-3 pb-3 ">
            <div class="col-md-auto me-5">
                <h1>{{ __('Training entry') }}</h1>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary">{{ __('create') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary">{{ __('edit') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary">{{ __('save') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary">{{ __('close') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary">{{ __('delete') }}</button>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col-6  ">
                <h3 class="m-0">{{ __('Teacher') }}:</h3>
            </div>
            <div class="col">
                <p>{{ __('from') }}:</p>
            </div>
            <div class="col">
                <p>{{ __('until') }}:</p>
            </div>
            <div class="col">
                <p>{{ __('duration') }}:</p>
            </div>
        </div>
        <div class="col pt-3 pb-3">
            <div class="col">
                <p>{{ __('Training') }}:</p>
            </div>
            <div class="col">
                <p>{{ __('TrainingsID') }}:</p>
            </div>
            <div class="col">
                <p>{{ __('area') }}:</p>
            </div>
            <div class="col">
                <p>{{ __('provider') }}:</p>
            </div>
        </div>

</div>
@endsection
