<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('technology');
    }
}
