<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Users;
use App\Support\Arr;

class GoogleController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(
        Request $request,
        protected Users $users,
    ) {
        parent::__construct($request);
    }

    /**
     * Redirects to google auth.
     *
     * @param string $driver
     * @return RedirectResponse
     */
    public function redirect(string $driver): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles google authentication
     *
     * @return RedirectResponse
     */
    public function callback(): RedirectResponse
    {
        try {
            $oauth = Socialite::driver('google')->user();

            if ($user = $this->users->findByEmail($oauth->getEmail())) {
                return $user->isActive()
                    ? $this->success($user, $oauth)
                    : $this->failure(Lang::get('admin.errors.account-suspended'));
            }

            return $this->failure(Lang::get('admin.errors.account-not-found'));
        } catch (Exception $e) {
            Log::error('Error authenticating customer via google', ['message' => $e->getMessage(), 'exception' => $e]);
            return $this->failure();
        }
    }

    /**
     * Authentication success response
     *
     * @param User $user
     * @param \Laravel\Socialite\Contracts\User|null $oauth
     * @return RedirectResponse
     */
    public function success(User $user, \Laravel\Socialite\Contracts\User $oauth = null): RedirectResponse
    {
        if (!is_null($oauth)) {
            $attrs = Arr::compact([
                'name' => $oauth->getName(),
                'google_auth_id' => $oauth->getId(),
                'avatar' => base64_encode(file_get_contents($oauth->getAvatar()))
            ]);

            $this->users->update($user, $attrs);
        }

        Auth::guard()->login($user, true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Authentication failure response.
     *
     * @param string|null $message
     * @return RedirectResponse
     */
    public function failure(string $message = null): RedirectResponse
    {
        $message = $message ?: Lang::get('admin.errors.login');

        return redirect()->route('auth.login')->with('status', ['type' => 'error', 'message' => $message]);
    }
}
