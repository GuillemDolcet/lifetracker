@extends('layouts.main')

@section('page-header')
    <div class="page-header d-print-none text-white">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Overview
                        </h2>
                    </div>
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-sm-inline-block fw-bold"
                           data-controller="remote-modal"
                           data-action="remote-modal#toggle"
                           data-remote-modal-target-value="#user-form-modal">
                            @svg(users-plus) <span
                                class="ms-2">@langUpperCase('trip.add') @langUpperCase('trip.user')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            hola
        </div>
    </div>
@endsection
