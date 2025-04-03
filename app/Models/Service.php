<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'icon',
        'name',
        'title',
        'description',
        'lang',
        'parent_id',
        'article_id',
    ];

    /**
     * Get the parent service.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    /**
     * Get the children services.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    /**
     * Get the related article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Scope a query to only include primary services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrimary($query)
    {
        return $query->whereNull('parent_id');
    }
    
    /**
     * Scope a query to filter by language.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $lang
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByLang($query, $lang)
    {
        return $query->where('lang', $lang);
    }

}
