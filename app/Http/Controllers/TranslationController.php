<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;

final class TranslationController extends Controller
{
    /**
     * [GET] /translations/{translation}
     * translations
     *
     * Returns the translated text.
     */
    public function get(string $translation): string
    {
        return Lang::has($translation) ? __($translation) : '';
    }
}
