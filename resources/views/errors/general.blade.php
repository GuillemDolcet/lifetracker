@extends('layouts.application')

@section('main-content')
    <div class="page page-center border-top-wide border-primary">
        <div class="container py-4">
            <div class="empty">
                <div class="empty-header">
                    @yield('code')
                </div>
                <p class="empty-title">
                    @yield('title')
                </p>
                <div class="empty-action">
                    <a href="{{ route('index') }}" class="btn btn-primary">
                        Take me home
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
