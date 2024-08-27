<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\SocialAuth;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Providers\RouteServiceProvider;
use App\Repositories\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
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

    public function redirect($social): RedirectResponse
    {
        $social = Social::where('name', $social)->firstOrFail();

        return $this->getService($social)->redirect();
    }

    public function callback($social): RedirectResponse
    {
        $social = Social::where('name', $social)->firstOrFail();

        $socialUser = $this->getService($social)->callback();

        $user = $this->users->newQuery()->firstOrCreate(
            [
                'email' => $socialUser->resource['email']
            ], [
                'name' => $socialUser->resource['name'],
                'avatar' => base64_encode(file_get_contents($socialUser->resource['avatar'])),
            ]
        );

        $user->socials()->syncWithoutDetaching($social, ['social_auth_id' => $socialUser->resource['social_id']]);

        Auth::guard()->login($user, true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function getService(Social $social): SocialAuth
    {
        // Convertir el nombre del driver a PascalCase para buscar la clase
        $serviceClass = 'App\\Services\\Socials\\' . ucfirst($social->name) . 'Service';

        if (!class_exists($serviceClass)) {
            abort(404, "Driver '$social->name' no soportado.");
        }

        $service = app($serviceClass);

        if (!$service instanceof SocialAuth) {
            abort(500, "El servicio '$social->name' no implementa SocialAuthInterface.");
        }

        return $service;
    }
}
