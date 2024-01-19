@extends('layouts.sidebar')

@section('title')
    {{ __('Admin') }}
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('List of users') }}</h2>
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-outline-success createTeacherButton" data-modalId="3">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new teacher') }}
                </button>
            </div>
            @include('alerts.default')
        </div>
    </div>
    <div class="row mb-2">
        <ul class="list-group mt-5">
            @foreach($users as $user)
                <li class="list-group-item d-flex justify-content-between">
                    <div class="userInfos">
                        <p class="m-0 name">
                            {{ $user->name }} ({{ $user->abbreviation }})
                        </p>
                        <p class="m-0 text-muted role">
                            {{ __(ucfirst($user->getRoleName())) }}
                        </p>
                    </div>
                    <div class="managingButtons ms-2">
                        <button type="button" class="btn btn-primary editTeacherButton"
                                data-modalId="2" data-teacherId="0">
                            <i class="bi bi-pencil-fill"></i> {{ __('Edit') }}
                        </button>
                        <button type="button" class="btn btn-danger deleteTeacherButton"
                                data-modalId="1" data-teacherId="0">
                            <i class="bi bi-trash-fill"></i> {{ __('Delete') }}
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{ $users->links() }}
@endsection
