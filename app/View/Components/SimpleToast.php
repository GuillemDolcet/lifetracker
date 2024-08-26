<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\View\Component;

final class SimpleToast extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): ConsoleApplication|FoundationApplication|View|Factory
    {
        return view('components.simple-toast');
    }
}
