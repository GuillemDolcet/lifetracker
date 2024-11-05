@extends('layouts.main')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-xl-3 col-sm-3 col-12 mt-1 mb-1">
                    <h2 class="page-title">
                        @svg(calendar) <span class="ms-2">@langUpperCase('general.calendar')</span>
                    </h2>
                </div>
                <div class="btn-list col-sm-9 col-xl-9 col-12 justify-content-end">
                    <a href="#" class="btn btn-primary d-sm-inline-block fw-bold col-12 col-sm-5 col-lg-4 col-xl-3 mt-1 mb-1"
                       data-controller="remote-modal"
                       data-action="remote-modal#toggle"
                       data-remote-modal-url-value="{{ route('events.create') }}"
                       data-remote-modal-target-value="#event-form-modal">
                        @svg(plus) <span class="ms-2">@langUpperCase('general.new') @lang('general.event')</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div
                data-controller="event"
                data-event-target="calendar">
        </div>
    </div>
@endsection
