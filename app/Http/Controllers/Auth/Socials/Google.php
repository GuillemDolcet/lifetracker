<?php

namespace App\Http\Controllers\Auth\Socials;

use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Google implements SocialAuthInterface
{
    public function redirect(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): array
    {
        $user = Socialite::driver('google')->stateless()->user();

        return [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
        ];
    }
}
