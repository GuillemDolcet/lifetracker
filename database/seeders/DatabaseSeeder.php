<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Social;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'es',
            'image' => 'es.png',
        ]);

        Language::create([
            'name' => 'ca',
            'image' => 'ca.png',
        ]);

        Language::create([
            'name' => 'de',
            'image' => 'de.png',
        ]);

        Language::create([
            'name' => 'en',
            'image' => 'en.png',
        ]);

        Social::create([
           'name' => 'google'
        ]);

        Social::create([
            'name' => 'github'
        ]);
    }
}
