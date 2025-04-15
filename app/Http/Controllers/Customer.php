<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class Customer extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $article = Article::find($request->route('id'));
        return view('customers.show', ['article' => $article]);

    }
}
