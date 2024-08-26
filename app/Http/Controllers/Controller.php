<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\InteractsWithTurbo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use InteractsWithTurbo;
    use ValidatesRequests;

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(protected Request $request) {}
}
