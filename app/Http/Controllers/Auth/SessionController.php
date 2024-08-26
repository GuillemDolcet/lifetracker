<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Language;
use App\Models\Location;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

final class SessionController extends Controller
{
    use AuthenticatesUsers;
    use ThrottlesLogins;

    /*
     * Define maxAttempts of login form
     */
    protected int $maxAttempts = 3;

    /*
     * Define decayMinutes when user uses all the attempts
     */
    protected int $decayMinutes = 2;

    /**
     * [GET] /auth/login
     * login
     *
     * Returns the login view in case the user is not authenticated.
     */
    public function create(): ConsoleApplication|FoundationApplication|View|Factory
    {
        return view('auth.login');
    }

    /**
     * [POST] /auth/login
     * authenticate
     *
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request),
            );

            return redirect()
                ->route('login')
                ->with([
                    'status' => [
                        'type' => 'error',
                        'message' => trans('auth.throttle', [
                            'seconds' => $seconds,
                            'minutes' => ceil($seconds / 60),
                        ]),
                    ],
                ]);
        }

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            if ($request->session()->has('locale') && (current_user() instanceof \Illuminate\Contracts\Auth\Authenticatable && current_user()->exists)) {
                current_user()->update([
                    'preference_language' => Language::query()->where('name', $request->session()->get('locale'))->first()->getKey(),
                ]);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $this->incrementLoginAttempts($request);

        return redirect()
            ->route('login')
            ->with([
                'status' => ['type' => 'error', 'message' => __('auth.failed')],
            ]);
    }

    /**
     * [DELETE] /auth/logout
     * logout
     *
     * Logs the customer out removing all the session storage information and redirects to home.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard()->logout();

        $mode = $request->session()->get('mode');

        $locale = $request->session()->get('locale');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($mode) {
            $request->session()->put('mode', $mode);
        }

        if ($locale) {
            Session::put('locale', $locale);
            $request->session()->put('locale', $locale);
        }

        return redirect()->to(RouteServiceProvider::HOME);
    }

    /**
     * [POST] /session/company/{company}/{route?}
     * session.company
     *
     * Change session storage company if authorized.
     *
     * @throws AuthorizationException
     */
    public function company(
        Company $company,
        ?string $route = null,
    ): Renderable|RedirectResponse {
        $this->authorize('changeCompany', [Company::class, $company]);

        $params = [];
        if (request()->has('params')) {
            $params = json_decode((string) request()->input('params'), true);
        }

        session()->put('company', $company->id);

        if (isset($route)) {
            return redirect()->route($route, $params);
        }

        return redirect()->back();
    }

    /**
     * [POST] /session/location/{location}/{route?}
     * session.location
     *
     * Change session storage location if authorized.
     *
     * @throws AuthorizationException
     */
    public function location(
        ?Location $location = null,
        ?string $route = null,
    ): Renderable|RedirectResponse {
        if ( ! isset($location)) {
            session()->remove('location');
        } else {
            $this->authorize('changeLocation', [
                Location::class,
                current_company(),
                $location,
            ]);

            $params = [];
            if (request()->has('params')) {
                $params = json_decode(
                    (string) request()->input('params'),
                    true,
                );
            }

            session()->put('location', $location->id);

            if (isset($route)) {
                return redirect()->route($route, $params);
            }
        }

        return redirect()->back();
    }

    /**
     * [POST] /session/activity/{activity}/{route?}
     * session.activity
     *
     * Change session storage activity if authorized.
     *
     * @throws AuthorizationException
     */
    public function activity(
        ?Activity $activity = null,
        ?string $route = null,
    ): Renderable|RedirectResponse {
        if ( ! isset($activity)) {
            session()->remove('activity');
        } else {
            $this->authorize('changeActivity', [
                Activity::class,
                current_company(),
                $activity,
                current_location(),
            ]);

            $params = [];
            if (request()->has('params')) {
                $params = json_decode(
                    (string) request()->input('params'),
                    true,
                );
            }

            session()->put('activity', $activity->id);

            if (isset($route)) {
                return redirect()->route($route, $params);
            }
        }

        return redirect()->back();
    }

    /**
     * [POST] /session/mode/{mode}
     * session.mode
     *
     * Change to dark/light mode
     *
     */
    public function mode(
        string $mode,
    ): Renderable|RedirectResponse {
        if ('dark' === $mode || 'light' === $mode) {
            session()->put('mode', $mode);
        }

        return redirect()->back();
    }

    /**
     * [POST] /session/locale/{locale}
     * session.locale
     *
     * Changes the local language, then redirect to the last page.
     */
    public function locale(Language $language): RedirectResponse
    {
        session()->put('locale', $language->name);

        if (current_user() instanceof \Illuminate\Contracts\Auth\Authenticatable && current_user()->exists) {
            current_user()->update([
                'preference_language' => $language->getKey(),
            ]);
        }

        return redirect()->back();
    }
}
