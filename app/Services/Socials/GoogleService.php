<?php

declare(strict_types=1);

namespace App\Services\Socials;

use App\Contracts\SocialAuth;
use App\Http\Resources\SocialUser;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

final class GoogleService implements SocialAuth
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): SocialUser
    {
        $user = Socialite::driver('google')->stateless()->user();

        return new SocialUser([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'social_auth_id' => $user->id,
        ]);
    }
}
