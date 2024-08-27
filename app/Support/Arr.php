<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr as LaravelArr;

final class Arr extends LaravelArr
{
    /**
     * Returns a copy of the supplied array with all (null) elements removed.
     */
    public static function compact(array $ary): array
    {
        return array_filter($ary, static fn($el): bool => ! empty($el));
    }

    /**
     * Get all the given array except for a specified array of keys.
     */
    public static function without(
        array $ary,
        string $key,
        ?string $value = null,
    ): array {
        if ( ! array_key_exists($key, $ary)) {
            return $ary;
        }

        if (null === $value) {
            return static::except($ary, $key);
        }

        $position = array_search($value, $ary[$key], true);

        if (false === $position) {
            return $ary;
        }

        unset($ary[$key][$position]);

        return $ary;
    }

    /**
     * Determine if two array are equals taking only in care if both have the key
     */
    public static function compare(array $ary, array $array): bool
    {
        $result = true;
        foreach ($ary as $key => $value) {
            if (isset($array[$key]) && $array[$key] !== $value) {
                $result = false;
                break;
            }
        }

        return $result;
    }
}
