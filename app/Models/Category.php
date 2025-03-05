<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'description', 'icon', 'icon_type', 'lang'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}