<?php

namespace gocrew\LaravelReAuth\Http\Controllers;

use gocrew\LaravelReAuth\Reauthenticates;
use Illuminate\Routing\Controller;

class ReAuthController extends Controller
{
    use Reauthenticates;

    /**
     * Create a new reauth controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
