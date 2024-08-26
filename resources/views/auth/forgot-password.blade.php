@extends('layouts.single')

@section('content')
    <div class="text-center mb-4">
        <a href="{{ route('login') }}">
            <img src="{{ image_url(!session()->has('mode') || session()->get('mode') == 'light' ? 'logo-dark.png' : 'logo-light.png') }}" height="30" alt="{{ config('app.name') }}">
        </a>
    </div>

    <div class="container-tight">
        <div class="card card-md">
            <div class="card-body">
                <x-status-message class="fs-5"/>
                <h2 class="h2 text-center mb-4">@langUpperCase('auth.reset_password')</h2>
                <form action="{{ route('password.email') }}" method="post" autocomplete="off">
                    <div class="input-group mt-3">
                        <label for="email" class="input-group-text">@svg(mail)</label>
                        <input id="email" type="text" name="email" class="form-control"
                               placeholder="@langUpperCase('auth.introduce-mail')" required>
                    </div>
                    <div class="form-footer mt-3">
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            @langUpperCase('general.continue')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
