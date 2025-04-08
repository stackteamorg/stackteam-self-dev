<?php

namespace App\Models;

use App\Traits\HasImages;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasImages;

    protected $fillable = ['title', 'icon', 'slug', 'content', 'author_id', 'category_id', 'lang', 'image', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
