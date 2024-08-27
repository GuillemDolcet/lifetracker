<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Resources\SocialUser;
use Illuminate\Http\RedirectResponse;

interface SocialAuth
{
    /**
     * Instantiates a new instance of the current repository's model class.
     */
    public function redirect(): RedirectResponse;

    /**
     * Instantiates a new instance of the current repository's model class with
     * the supplied attributes.
     *
     * If no attributes are supplied it should be just an alias for `getInstance()`.
     */
    public function callback(): SocialUser;
}
