@extends('layouts.single')

@section('content')
    <div class="text-center mb-4">
        <img src="{{ image_url(!session()->has('mode') || session()->get('mode') == 'light' ? 'logo-dark.png' : 'logo-light.png') }}" height="30" alt="{{ config('app.name') }}">
    </div>

    <div class="container-tight">
        <div class="card card-md">
            <div class="card-body">
                <x-status-message class="fs-5"/>
                <h2 class="h2 text-center mb-4">@langUpperCase('auth.access')</h2>
                <form action="{{ route('login') }}" method="post" autocomplete="off">
                    <div class="input-group mt-3">
                        <label for="username" class="input-group-text">@svg(user)</label>
                        <input id="username" type="text" name="username" class="form-control"
                               placeholder="@langUpperCase('auth.introduce-username')" required>
                    </div>
                    <div class="input-group mt-3">
                        <label for="password" class="input-group-text">@svg(key)</label>
                        <input id="password" type="password" name="password" class="form-control"
                               placeholder="@langUpperCase('auth.introduce-password')" required>
                    </div>
                    <div class="form-footer mt-3">
                        <button type="submit" class="btn btn-primary fw-bold w-100">@langUpperCase('auth.login')</button>
                    </div>
                </form>
                <a href="{{ route('password.request') }}"
                   class="d-flex justify-content-center mt-3">@lang('auth.forget_password')</a>
            </div>
            <div class="hr-text">@lang('general.or')</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('google.redirect') }}" class="btn w-100">
                            <span class="me-2">@svg(google)</span> @langUpperCase('auth.login') @lang('general.with') Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
