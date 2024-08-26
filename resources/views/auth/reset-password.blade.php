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
                <form action="{{ route('password.update') }}" method="post" autocomplete="off">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <label class="form-label fw-bold" for="password">@langUpperCase('passwords.password')</label>
                    <div class="input-group">
                        <span class="input-group-text">@svg(key)</span>
                        <input id="password" name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required autocomplete="off" min="10">
                    </div>
                    <div class="text-muted fs-6 password mt-1 d-flex flex-column">
                        <div>@langUpperCase('passwords.min-passwords.characters')</div>
                        <div>@langUpperCase('passwords.min-passwords.upper-lower')</div>
                        <div>@langUpperCase('passwords.min-passwords.digits')</div>
                        <div>@langUpperCase('passwords.min-passwords.symbols')</div>
                    </div>
                    @error('password')
                    <div class="text-danger fs-5">{{ $message }}</div>
                    @endif
                    <label class="form-label fw-bold"
                           for="password_confirmation">@langUpperCase('passwords.password_confirm')</label>
                    <div class="input-group">
                        <span class="input-group-text">@svg(key)</span>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control
                                    @error('password_confirmation') is-invalid @enderror"
                               required autocomplete="off">
                    </div>
                    @error('password_confirmation')
                    <div class="text-danger fs-5">{{ $message }}</div>
                    @endif
                    <div class="form-footer mt-3">
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            @langUpperCase('auth.reset_password')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
