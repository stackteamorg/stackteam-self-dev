<?php

namespace App\Http\Controllers;

use App\Services\Metatag;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Metatag $metatag)
    { 

        return view('about');
    }
}
