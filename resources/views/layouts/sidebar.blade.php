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
                        @role('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link px-0 align-middle" href="#adminMenu" data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="article-menu">
                                <i class="fs-4 bi bi-person-fill-exclamation"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('Admin') }}</span>
                            </a>
                            <ul id="adminMenu" class="nav flex-column ms-1 collapse ms-1 ms-md-3">
                                @can('user.create')
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0 bi bi-person-standing">
                                        <span class="d-none d-xl-inline">
                                            User Create (Example)
                                        </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('user.delete')
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0 bi bi-alarm-fill">
                                            <span class="d-none d-xl-inline">User Delete (Example)</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        @endrole


                        <hr>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link px-0 align-middle">
                                <i class="bi bi-box-arrow-right fs-4"></i>
                                <span class="ms-1 d-none d-xl-inline">{{ __('Logout') }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="pb-4 d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
            <div class="w-75 contentMargin">
                <div class="container-fluid mt-5">
                    @yield('extra-content')
                </div>
            </div>
        </div>
    </div>
@endsection
