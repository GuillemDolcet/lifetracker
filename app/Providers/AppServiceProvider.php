<?php

declare(strict_types=1);

namespace App\Providers;

use DOMDocument;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        // Vite.js config
        $this->app
            ->make(Vite::class)
            ->useHotFile(
                'production' !== app('env')
                    ? storage_path('app/vite.hot')
                    : false,
            );

        /*
         * Blade directive to return a translation with
         * the first letter cast as uppercase
         */
        Blade::directive(
            'langUpperCase',
            static fn($lang): string => sprintf('<?php echo ucfirst(__(%s)) ?>', $lang),
        );

        /*
        * Blade directive to return a svg image as a
        * DOMDocument
        */
        Blade::directive('svg', static function ($arguments) {
            // Funky madness to accept multiple arguments into the directive
            [$path, $width, $height] = array_pad(
                explode(',', trim($arguments, '() ')),
                3,
                '',
            );
            $path = trim($path, "' ");
            $width = trim($width, "' ");
            $height = trim($height, "' ");
            // Create the dom document as per the other answers
            $svg = new DOMDocument();
            if (Storage::disk('icons')->exists($path . '.svg')) {
                $svg->load(Storage::disk('icons')->path($path . '.svg'));

                if ('' !== $width) {
                    $svg->documentElement->setAttribute('width', $width);
                }

                if ('' !== $height) {
                    $svg->documentElement->setAttribute('height', $height);
                }

                return $svg->saveXML($svg->documentElement);
            }
        });
    }
}
