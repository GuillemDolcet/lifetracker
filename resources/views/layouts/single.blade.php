@extends('layouts.application')

@section('main-content')
    @section('header')
    @show

    <div class="page page-center border-top-wide border-primary">
        <div class="p-3 cursor-pointer d-flex align-items-center justify-content-end">
            <div class="me-3 dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <img src="{{ image_url(app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    @foreach(\App\Models\Language::whereNot('name', app()->getLocale())->get() as $language)
                        <form method="post" class="dropdown-item" action="{{ route('session.locale', $language->getKey()) }}"
                              data-controller="form">
                            @csrf
                            <a href="#" class="w-100 text-decoration-none d-flex align-items-center"
                               title="@langUpperCase('auth.logout')"
                               data-action="form#submit">
                                <img src="{{ image_url($language->image) }}" alt="{{ $language->name }}">
                                <div class="fw-medium ms-2">{{ ucfirst(__("general.languages.$language->name")) }}</div>
                            </a>
                        </form>
                    @endforeach
                </div>
            </div>
            @if(!session()->has('mode') || session()->get('mode') == 'light')
                <div
                    data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('general.theme.dark')"
                    data-bs-original-title="@langUpperCase('general.theme.dark')">
                    <form method="post"
                          action="{{ route('session.mode', ['mode' => 'dark']) }}" data-controller="form">
                        @csrf
                        <a href="#" class="text-decoration-none" data-action="form#submit">
                            @svg(moon, 24, 24)
                        </a>
                    </form>
                </div>
            @else
                <div
                    data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="@langUpperCase('general.theme.light')"
                    data-bs-original-title="@langUpperCase('general.theme.light')">
                    <form method="post"
                          action="{{ route('session.mode', ['mode' => 'light']) }}" data-controller="form">
                        @csrf
                        <a href="#" class="text-decoration-none" data-action="form#submit">
                            @svg(sun, 32, 32)
                        </a>
                    </form>
                </div>
            @endif
        </div>
        @section('page-body')
            <div class="container py-4">
                @yield('content')
            </div>
        @show
    </div>

    @section('footer')
    @show
@endsection
