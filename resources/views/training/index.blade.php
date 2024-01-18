@extends('layouts.sidebar')

@section('extra-content')
    <div class="container">

        <div class="row pt-3 pb-3 ">
            <div class="col-md-auto me-6">
                <h1>{{ __('Training') }}</h1>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-folder-fill"> </i>{{ __('create') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"> </i>{{ __('edit') }}</button>

            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-arrow-down-square"> </i>{{ __('save') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-ban"> </i> {{ __('close') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-trash-fill"> </i>{{ __('delete') }}</button>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col-6  ">
                <label for="title" class="form-label">{{ __('Title') }}:</label>
                <input type="text" class="form-control" name="title" id="title" >
            </div>
        </div>
        <div class="col pt-3 pb-3">
            <div class="col">
                <label for="area">{{ __('Area') }}:</label>
                <select class="form-control" id="area">
                    @foreach($areas as $area)
                        <option>{{$area->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="provider">{{ __('Provider') }}:</label>
                <select class="form-control" id="provider">
                    @foreach($providers as $provider)
                        <option>{{$provider->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>


@endsection
