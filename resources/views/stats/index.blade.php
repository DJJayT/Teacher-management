@extends('layouts.sidebar')

@section('title')
    {{ __('Statistics') }}
@endsection

@section('extra-content')
    <div class="row mb-2">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>{{ __('Statistics for year :year', ['year' => $year]) }}</h2>
        </div>
        @include('alerts.default')
    </div>
    <div class="row mb-2">
        <h4 class="mt-3">{{ __('From A13 or E13 and comparable') }}</h4>
        @include('stats.statsElement', ['stat' => $stats->aboveA13])

        <h4 class="mt-3">{{ __('A9-A12, E9-E12 and comparable') }}</h4>
        @include('stats.statsElement', ['stat' => $stats->a9ToA12])

        <h4 class="mt-3">{{ __('Until A8 or E8 and comparable') }}</h4>
        @include('stats.statsElement', ['stat' => $stats->belowA9])


        <nav class="d-flex justify-items-center justify-content-center">
            <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                <div>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="{{ route('stats', ['year' => $year - 1]) }}" rel="prev"
                               aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>

                        @for ($i = -2; $i <= 2; $i++)
                            @if ($i == 0)
                                <li class="page-item active" aria-current="page"><span
                                        class="page-link">{{ $year + $i }}</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ route('stats', ['year' => $year + $i]) }}">{{ $year + $i }}</a>
                                </li>
                            @endif
                        @endfor

                        <li class="page-item">
                            <a class="page-link" href="{{ route('stats', ['year' => $year + 1]) }}" rel="next"
                               aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
@endsection
