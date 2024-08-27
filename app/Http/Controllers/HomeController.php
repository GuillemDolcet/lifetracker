<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Console\Application as ConsoleApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct(
        Request $request,
    ) {
        parent::__construct($request);
    }

    /**
     * [GET] /
     * index
     *
     * Returns the login view.
     */
    public function index(): ConsoleApplication|FoundationApplication|View|Factory
    {
        return view('home.index');
    }
}
