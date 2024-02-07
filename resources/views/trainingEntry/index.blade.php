@extends('layouts.sidebar')

@section('extra-content')

    <div class="container">
        <div class="row pt-3 pb-3 ">
            <div class="col-md-auto me-5">
                <h1>{{ __('Training entry') }}</h1>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-folder-fill"> </i> {{ __('create') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"> </i> {{ __('edit') }}</button>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-arrow-down-square"> </i> {{ __('save') }}</button>
            </div>
            <div class="col p-0 m-1">
                <a href="{{ route('teacher.trainings', ['id' => $teacher->id]) }}" class="btn btn-info">
                    <i class="bi bi-ban"> </i> {{ __('close') }}
                </a>
            </div>
            <div class="col p-0 m-1">
                <button type="button" class="btn btn-primary"><i class="bi bi-trash-fill"> </i> {{ __('delete') }}</button>
            </div>
        </div>
        <div class="row pt-3 pb-3">
            <div class="col-6  ">
                <h3 class="m-0">{{ __('Teacher') }}:  {{ $teacher->getName() }}</h3>
            </div>
            <div class="col">
                <label for="from">{{ __('from') }}:</label><input type="date" class="form-control" name="from" id="from">
            </div>
            <div class="col">
                <label for="until">{{ __('until') }}:</label><input type="date" class="form-control" name="until" id="until">
            </div>
            <div class="col">
                <label for="duration">{{ __('duration') }}:</label><input type="text" class="form-control" name="duration" id="duration">
            </div>
        </div>
        <div class="col pt-3 pb-3">
            <div class="col">
                <label for="training">{{ __('Training') }}:</label>
                <select class="form-control" id="training">
                    @foreach($trainings as $training)
                        <option>{{$training->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="area">{{ __('area') }}:</label>
                <select class="form-control" id="area">
                    @foreach($areas as $area)
                        <option>{{$area->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="provider">{{ __('provider') }}:</label>
                <select class="form-control" id="provider">
                    @foreach($providers as $provider)
                        <option>{{$provider->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

</div>
@endsection
