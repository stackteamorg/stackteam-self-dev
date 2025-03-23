<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article as ArticleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Article extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function __invoke(Request $request)
    {
        $articles = ArticleModel::latest()->paginate(10);
        return view('blog.index', compact('articles'));
    }

    /**
     * Display the specified article.
     *
     * @param string $slug
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {

        $article = ArticleModel::findOrFail((int) request()->route('id'));
        
        // Check if the slug matches to ensure proper URL
        if ($article->slug !== request()->route('slug')) {
            abort(404);
        }
        
        return view('blog.article', compact('article'));
    }

    /**
     * Update the article content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

   

}
