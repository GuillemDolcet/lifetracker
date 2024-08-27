<?php

namespace App\Services\Socials;

use App\Contracts\SocialAuth;
use App\Http\Resources\SocialUser;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GithubService implements SocialAuth
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(): SocialUser
    {
        $user = Socialite::driver('github')->stateless()->user();

        return new SocialUser([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'social_id' => $user->id,
        ]);
    }
}
