<?php

namespace gocrew\LaravelReAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use gocrew\LaravelReAuth\Reauthenticates;

class ReAuthController extends Controller
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
