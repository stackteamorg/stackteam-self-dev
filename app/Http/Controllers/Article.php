<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article as ArticleModel;
use App\Models\Category;
use App\Models\Image;
use App\Services\Metatag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Article extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function __invoke(Request $request)
    {

        $query = ArticleModel::where('lang', app()->getLocale())
                             ->where('status', 'published')
                             ->whereNotNull('category_id');
                             
        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $articles = $query->latest()->paginate(10);
        return view('blog.index', compact('articles'));
    }

    public function category(Request $request, Metatag $metatag)
    {


        $category = Category::where('name', request()->route('name'))->first();

        $metatag->setTitle(Lang::get('metatags.blog-index.title') . ' | '  . $category->title);
        $metatag->setDescription($category->description);
        $metatag->setType('article');

        $query = ArticleModel::where('lang', app()->getLocale())
                             ->where('status', 'published')
                             ->where('category_id', $category->id);
                             
        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $articles = $query->latest()->paginate(10);

        return view('blog.index', ['articles' => $articles, 'category' => $category]);
    }

    /**
     * Display the specified article.
     *
     * @param string $slug
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(Metatag $metatag)
    {
        $article = ArticleModel::findOrFail((int) request()->route('id'));
        
        // Check if the slug matches to ensure proper URL
        if ($article->slug !== request()->route('slug')) {
            abort(404);
        }

        // Check if article status is published or if user is logged in with specific email
        $isAuthorizedUser = Auth::check() && Auth::user()->id === $article->author_id;
        
        // Only show published articles or drafts for authorized user
        if ($article->status !== 'published' && !$isAuthorizedUser) {
            abort(404);
        }

        $metatag->setTitle(Lang::get('metatags.public.site_name') . ' | ' . $article->title);
        $metatag->setDescription($article->description);
        $metatag->setAuthor($article->author->name);
        $metatag->setType('article');
        
        return view('blog.article', compact('article'));
    }

    /**
     * Update the article content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Upload an image for the article via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'article_id' => 'required|exists:articles,id',
            'image' => 'required|image|max:5120', // Max 5MB
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get article
            $article = ArticleModel::findOrFail($request->article_id);
            
            // Get uploaded file
            $uploadedFile = $request->file('image');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $mimeType = $uploadedFile->getMimeType();
            $size = $uploadedFile->getSize();
            $extension = $uploadedFile->getClientOriginalExtension();
            
            // Generate unique filename
            $filename = Str::uuid() . '.' . $extension;
            
            // Store original image
            $uploadedFile->storeAs('article-images', $filename);
            
            // Create image record
            $imageModel = new Image([
                'filename' => $filename,
                'original_filename' => $originalFilename,
                'mime_type' => $mimeType,
                'size' => $size,
                'path' => 'article-images/' . $filename,
                'alt_text' => $request->alt_text,
            ]);
            
            // Associate with article
            // $article->image()->save($imageModel);
            
            // ذخیره دستی با نام کامل کلاس
            $imageModel->imageable_type = 'App\\Models\\Article';
            $imageModel->imageable_id = $article->id;
            $imageModel->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => [
                    'image_id' => $imageModel->id,
                    'article_id' => $article->id,
                    'filename' => $filename,
                    'url' => asset('storage/article-images/' . $filename),
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
