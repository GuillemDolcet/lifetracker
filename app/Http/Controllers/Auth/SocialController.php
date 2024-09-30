<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Contracts\SocialAuth;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Providers\RouteServiceProvider;
use App\Repositories\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class SocialController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(Request $request, protected Users $users)
    {
        parent::__construct($request);
    }

    /**
     * [GET] /socials/{social}
     * socials.redirect
     *
     * Redirect to social login page if social exists
     */
    public function redirect($social): RedirectResponse
    {
        $social = Social::query()->where('name', $social)->firstOrFail();

        return $this->getService($social)->redirect();
    }

    /**
     * [GET] /socials/{social}/callback
     * socials.callback
     *
     * Process the callback of social login, if email exists we attach de social account.
     * After that the user is redirected to the home page
     */
    public function callback($social): RedirectResponse
    {
        $social = Social::query()->where('name', $social)->firstOrFail();

        $socialUser = $this->getService($social)->callback();

        $user = $this->users->newQuery()->firstOrCreate(
            [
                'email' => $socialUser->resource['email'],
            ],
            [
                'name' => $socialUser->resource['name'],
                'avatar' => base64_encode(file_get_contents($socialUser->resource['avatar'])),
            ],
        );

        $user->socials()->syncWithoutDetaching([$social->getKey() => ['social_auth_id' => $socialUser->resource['social_auth_id']]]);

        Auth::guard()->login($user, true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Get service by Social model
     */
    private function getService(Social $social): SocialAuth|RedirectResponse
    {
        $serviceClass = 'App\\Services\\Socials\\' . ucfirst($social->name) . 'Service';

        if ( ! class_exists($serviceClass)) {
            return redirect()->back();
        }

        $service = app($serviceClass);

        if ( ! $service instanceof SocialAuth) {
            return redirect()->back();
        }

        return $service;
    }
}
