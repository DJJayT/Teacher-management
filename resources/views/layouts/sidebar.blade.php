@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col col-1 col-md-1 col-xl-2 px-md-1 px-0 bg-dark noselect sidebar position-fixed">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <p class="d-flex align-items-center text-white text-decoration-none mb-2">
                        <span class="fs-5 d-none d-xl-inline">{{ __('Menu') }}</span>
                    </p>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="bi bi-house-door-fill fs-4"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('Home') }}</span>
                            </a>
                        </li>

                    </ul>
                    <div class="pb-4 d-none d-md-inline">
                        Hier könnte Ihre Werbung stehen
                    </div>
                </div>
            </div>
            <div class="w-75 contentMargin">
                @yield('extra-content')
            </div>
        </div>
    </div>
@endsection
