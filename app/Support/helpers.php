<?php

declare(strict_types=1);

use App\Models\User;
use App\Support\Asset;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

// Assets //////////////////////////////////////////////////////////////////////

if ( ! function_exists('image_url')) {
    /**
     * Return the path to an image asset (or versioned one if exists).
     */
    function image_url(string $path, ?bool $secure = null): string
    {
        return Asset::imageUrl($path, $secure);
    }
}

if ( ! function_exists('all_socials')) {
    /**
     * Return all the socials of the app
     */
    function all_socials(): Collection
    {
        return App\Models\Social::all();
    }
}

// User ////////////////////////////////////////////////////////////////////////

if ( ! function_exists('current_user')) {
    /**
     * Get the currently logged in customer.
     */
    function current_user(?string $guard = null): User|Authenticatable|null
    {
        return auth($guard)->user();
    }
}
