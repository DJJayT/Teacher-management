@extends('layouts.sidebar')

@section('extra-content')

    <div class="container">

        <div class="row pt-3 pb-3 ">
            <div class="col-6">
                <h1>{{ __('Training entry') }}</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('create') }}</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('save') }}</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('edit') }}</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('close') }}</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary">{{ __('delete') }}</button>
            </div>
        </div>

    <br>
@endsection
