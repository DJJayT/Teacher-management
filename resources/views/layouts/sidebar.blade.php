@extends('layouts.app')

@section('sidebar-js')
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
        new sidebar();
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col col-1 col-md-1 col-xl-2 px-md-1 px-0 bg-dark noselect sidebar position-fixed">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <p class="d-flex align-items-center text-white text-decoration-none mb-2">
                        <span class="fs-5 d-none d-xl-inline">{{ __('sidebar.menu') }}</span>
                    </p>
                    <p class="text-muted mt-0 pb-3 mb-md-0 me-md-auto d-none d-xl-inline">
                        {{ Auth::user()->selectedCompany->getAlias() }}
                    </p>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="bi bi-house-door-fill fs-4"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.home') }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link px-0 align-middle" href="#timeTrackingMenu" data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="article-menu">
                                <i class="fs-4 bi bi-calendar-check-fill"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.time_tracking') }}</span>
                            </a>
                            <ul id="timeTrackingMenu" class="nav flex-column ms-1 collapse ms-1 ms-md-3">
                                <li class="w-100">
                                    <a href="{{ route('timeTracking.calendar') }}"
                                       class="nav-link px-0 bi bi-calendar-check-fill">
                                        <span
                                            class="d-none d-xl-inline">{{ __('sidebar.time_tracking_calendar') }}</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="{{ route('timeTracking.workTimes') }}"
                                       class="nav-link px-0 bi bi-alarm-fill">
                                        <span
                                            class="d-none d-xl-inline">{{ __('sidebar.time_tracking_my_times') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}"
                               class="nav-link px-0 align-middle">
                                <i class="fs-4 bi bi-envelope-fill"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.articles') }}</span>
                            </a>
                        </li>

                        @can('employee-management:show')
                            <li class="nav-item">
                                <a href="{{ route('employee.show') }}"
                                   class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi bi-people"></i>
                                    <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.employees') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('room-management:show')
                            <li class="nav-item">
                                <a href="{{ route('roomManagement.index') }}"
                                   class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi bi-door-open"></i>
                                    <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.room_management') }}</span>
                                </a>
                            </li>
                        @endcan

                        <hr>
                        @if(Auth::user()->companiesCount() > 1)
                            <li class="nav-item">
                                <a href="{{ route('companies.index') }}" class="nav-link px-0 align-middle">
                                    <i class="bi bi-person-workspace fs-4"></i>
                                    <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.change_company') }}</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link px-0 align-middle hover-cursor" id="profileSettingsButton"
                               data-userId="{{ Auth::user()->id }}" data-modalId="16">
                                <i class="bi bi-person-fill-gear fs-4"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('sidebar.settings') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link px-0 align-middle">
                                <i class="bi bi-box-arrow-right fs-4"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('login.logout') }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="pb-4 d-none d-md-inline">
                        {{ Auth::user()->getName() }}
                    </div>
                </div>
            </div>
            <div class="w-75 contentMargin">
                @yield('extra-content')
            </div>
        </div>
    </div>
@endsection
