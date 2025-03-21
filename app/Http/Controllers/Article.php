<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article as ArticleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function updateContent(Request $request)
    {
        $id = request()->route('id');
        // Find the article
        $article = ArticleModel::findOrFail($id);
        
        // Check user permission
        if (Auth::id() !== $article->author_id) {
            return response()->json([
                'success' => false,
                'message' => __('article.permission_denied')
            ], 403);
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('article.invalid_data'),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save new content
            $article->content = json_encode($request->content);
            $article->save();

            return response()->json([
                'success' => true,
                'message' => __('article.update_success'),
                'article' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'updated_at' => $article->updated_at->format('Y-m-d H:i:s')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('article.update_error', ['message' => $e->getMessage()])
            ], 500);
        }
    }
    
}
