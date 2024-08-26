<?php

declare(strict_types=1);

use App\Models\User;
use App\Support\Asset;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

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
