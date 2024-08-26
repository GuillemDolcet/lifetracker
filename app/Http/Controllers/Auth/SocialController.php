<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\SocialAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SocialController extends Controller
{
    public function redirect($driver): RedirectResponse
    {
        return $this->getService($driver)->redirect();
    }

    public function callback($driver)
    {
        return $this->getService($driver)->callback();
    }

    private function getService($driver): SocialAuth
    {
        // Convertir el nombre del driver a PascalCase para buscar la clase
        $serviceClass = 'App\\Services\\' . ucfirst($driver) . 'Service';

        if (!class_exists($serviceClass)) {
            abort(404, "Driver '$driver' no soportado.");
        }

        $service = app($serviceClass);

        if (!$service instanceof SocialAuth) {
            abort(500, "El servicio '$driver' no implementa SocialAuthInterface.");
        }

        return $service;
    }
}
