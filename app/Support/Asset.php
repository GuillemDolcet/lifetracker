<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Vite;

final class Asset
{
    /**
     * Returns the path to an asset (can be versioned if a mix-manifest.json file exists).
     */
    public static function path(
        string $path,
        string $base = 'resources/assets',
        string $buildDirectory = 'assets',
    ): string {
        return Vite::asset($base . $path, $buildDirectory);
    }

    /**
     * Return the path to a javascript asset (or versioned one if exists).
     */
    public static function javascriptPath(string $path): string
    {
        return self::path('/javascripts/' . $path);
    }

    /**
     * Return the path to a stylesheet asset (or versioned one if exists).
     */
    public static function stylesheetPath(string $path): string
    {
        return self::path('/stylesheets/' . $path);
    }

    /**
     * Return the path to an image asset (or versioned one if exists).
     */
    public static function imagePath(string $path): string
    {
        return self::path('/images/' . $path);
    }

    /**
     * Return the path to a font asset (or versioned one if exists).
     */
    public static function fontPath(string $path): string
    {
        return self::path('/fonts/' . $path);
    }

    /**
     * Returns the path to an asset (can be versioned if a mix-manifest.json file exists).
     */
    public static function url(string $path, ?bool $secure = null): string
    {
        return asset(self::path($path), $secure);
    }

    /**
     * Return the path to a javascript asset (or versioned one if exists).
     */
    public static function javascriptUrl(
        string $path,
        ?bool $secure = null,
    ): string {
        return asset(self::javascriptPath($path), $secure);
    }

    /**
     * Return the path to a stylesheet asset (or versioned one if exists).
     */
    public static function stylesheetUrl(
        string $path,
        ?bool $secure = null,
    ): string {
        return asset(self::stylesheetPath($path), $secure);
    }

    /**
     * Return the path to an image asset (or versioned one if exists).
     */
    public static function imageUrl(string $path, ?bool $secure = null): string
    {
        return asset(self::imagePath($path), $secure);
    }

    /**
     * Return the path to a font asset (or versioned one if exists).
     */
    public static function fontUrl(string $path, ?bool $secure = null): string
    {
        return asset(self::fontPath($path), $secure);
    }
}
