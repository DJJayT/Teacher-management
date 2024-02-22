@extends('layouts.sidebar')

@section('title')
    {{ __('Admin') }}
@endsection

@section('extra-js')
    <script src="{{ asset('js/userManagement.js') }}"></script>
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('List of users') }}</h2>
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-outline-success createUserButton" data-modalId="4">
                    <i class="bi bi-plus-circle"></i> {{ __('Create new user') }}
                </button>
            </div>
            @include('alerts.default')
        </div>
    </div>
    <div class="row mb-2">
        <ul class="list-group mt-5">
            @foreach($users as $user)
                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                    <div class="userInfos">
                        <p class="m-0 name">
                            {{ $user->name }} ({{ $user->abbreviation }})
                        </p>
                        <p class="m-0 text-muted role">
                            {{ __(ucfirst($user->getRoleName())) }}
                        </p>
                    </div>
                    <div class="managingButtons">
                        @can('user.edit')
                            <button type="button" class="btn btn-primary editUserButton my-1"
                                    data-modalId="5" data-userId="{{ $user->id }}">
                                <i class="bi bi-pencil-fill"></i> {{ __('Edit') }}
                            </button>
                        @endcan
                        @can('user.delete')
                            <button type="button" class="btn btn-danger deleteUserButton my-1"
                                    data-modalId="1" data-userId="{{ $user->id }}">
                                <i class="bi bi-trash-fill"></i> {{ __('Delete') }}
                            </button>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{ $users->links() }}
@endsection
