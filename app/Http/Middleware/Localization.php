<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\App;

final class Localization
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(
        protected Store $sessionStore,
    ) {}

    /**
     * Set the default language
     */
    public function handle($request, Closure $next)
    {
        if ($this->sessionStore->has('locale')) {
            App::setLocale($this->sessionStore->get('locale'));
        } else {
            $availableLanguages = Language::all()->pluck('name')->toArray();
            $userLanguages = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLanguages as $language) {
                if(in_array($language, $userLanguages)) {
                    App::setLocale($language);

                    $this->sessionStore->put('locale', $language);

                    if (current_user() instanceof \Illuminate\Contracts\Auth\Authenticatable && current_user()->exists) {
                        current_user()->update([
                            'preference_language' => $language->getKey(),
                        ]);
                    }

                    break;
                }
            }
        }

        return $next($request);
    }
}
