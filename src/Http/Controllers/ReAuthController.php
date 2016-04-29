<?php

namespace gocrew\LaravelReAuth\Http\Controllers;

use Illuminate\Routing\Controller;
use gocrew\LaravelReAuth\Reauthenticates;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ReAuthController extends Controller
{
    use Reauthenticates, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
}
