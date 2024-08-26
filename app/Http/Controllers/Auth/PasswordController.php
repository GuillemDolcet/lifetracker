<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users;
use App\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

final class PasswordController extends Controller
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
     * [GET] /auth/forgot-password
     * password.request
     *
     * Returns the forgot-password view
     */
    public function create(): ConsoleApplication|FoundationApplication|View|Factory
    {
        return view('auth.forgot-password');
    }

    /**
     * [GET] /auth/reset-password/{token}
     * password.reset
     *
     * Returns the reset password view if token valid
     */
    public function resetPassword(
        string $token,
    ): ConsoleApplication|FoundationApplication|View|Factory|RedirectResponse {
        $user = $this->users->findBy(['email' => $this->request->input('email')]);

        return $user instanceof User && Password::tokenExists($user, $token)
            ? view('auth.reset-password', [
                'token' => $token,
                'email' => $this->request->input('email'),
            ])
            : redirect()->route('login');
    }

    /**
     * [POST] /auth/forgot-password
     * password.email
     *
     * Generates a reset link and send it to the user mail
     */
    public function email(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink($request->only('email'));

        return Password::RESET_LINK_SENT === $status
            ? back()->with([
                'status' => ['type' => 'success', 'message' => __($status)],
            ])
            : back()->with([
                'status' => ['type' => 'error', 'message' => __($status)],
            ]);
    }

    /**
     * [POST] /auth/reset-password
     * password.update
     *
     * Resets the password by previous token generated and verified
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(10)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token',
            ),
            static function (User $user, string $password): void {
                $user
                    ->forceFill([
                        'password' => Hash::make($password),
                    ])
                    ->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            },
        );

        return Password::PASSWORD_RESET === $status
            ? redirect()
                ->route('login')
                ->with([
                    'status' => ['type' => 'success', 'message' => __($status)],
                ])
            : back()->with([
                'status' => ['type' => 'error', 'message' => __($status)],
            ]);
    }
}
