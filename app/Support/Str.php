<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Str as LaravelStr;

final class Str extends LaravelStr
{
    /**
     * Returns a new string with the given record separator removed from the end
     * of str (if present).
     * If `$separator` has not been changed from the default, then `str_chomp` also
     * removes carriage return characters (that is it will remove \n, \r, and \r\n).
     */
    public static function chomp(string $input, mixed $separator = null): string
    {
        if ('' === $input || '0' === $input) {
            return $input;
        }

        $sep = preg_quote((string) ($separator ?: '\n\r'));

        return preg_replace('/[' . $sep . ']+$/', '', $input);
    }

    /**
     * 'Normalizes' the supplied string and uppercase's it.
     */
    public static function normalize(
        string $input,
        string $default = '',
    ): string {
        $normalized = '' !== static::slug($input) ? $input : $default;

        // Trim & collapse whitespace
        $normalized = mb_ereg_replace(
            '^[[:space:]]+|[[:space:]]+\$',
            '',
            $normalized,
            'msr',
        );
        $normalized = mb_ereg_replace('[[:space:]]+', ' ', $normalized, 'msr');

        return mb_strtoupper($normalized);
    }

    /**
     * Breaks the supplied string into lines and cleans trailing space and carriage returns
     */
    public static function breakIntoLines(
        string $input,
        string $separator = '\n',
    ): array {
        return array_filter(
            array_map(
                static fn($l): string => trim(self::chomp($l)),
                explode($separator, $input),
            ),
            'strlen',
        );
    }

    /**
     * Returns a new string with accents removed.
     */
    public static function unaccent(string $input): string
    {
        $search = [];
        $replace = [];
        $translations = get_html_translation_table(
            HTML_ENTITIES,
            ENT_COMPAT | ENT_HTML5,
        );

        foreach ($translations as $k => $v) {
            if (ord($k) >= 192) {
                $search[] = $k;
                $replace[] = $v[1];
            }
        }

        return str_replace($search, $replace, $input);
    }

    /**
     * Generic string value cast function.
     */
    public static function cast(mixed $value): string
    {
        return trim((string) $value);
    }

    /**
     * Generic string value cast function w/null propagation.
     */
    public static function castOrNull(mixed $value): ?string
    {
        $conv = self::cast($value);

        return '' === $conv || '-' === $conv ? null : $conv;
    }

    /**
     * Generic int cast function.
     */
    public static function toInt(mixed $value): int
    {
        return (int) self::cast($value);
    }

    /**
     * Removes all leading zeros from a string.
     *
     * @param string $input The string from which leading zeros will be removed.
     * @return string The string without leading zeros.
     */
    public static function removeLeadingZeros(string $input): string
    {
        // Use ltrim to remove all leading zeros
        // If the string contains only zeros, return a single zero
        return '' === ltrim($input, '0') ? '0' : ltrim($input, '0');
    }
}
