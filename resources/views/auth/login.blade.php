@extends('layouts.app')

@section('title', 'Login')

@section('extra-css')
    <style>
        .btn {
            display: block !important;
            width: 100%;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 30rem">
            <div class="card-body">
                <h5 class="card-title">{{ __('Login') }}</h5>
                @include('alerts.default')
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-1">
                        <label for="password" class="formlabel">{{ __('Password') }}</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                        {{ __('Remember me') }}
                    </div>


                    <button id="submit" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>

@endsection
