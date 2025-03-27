<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Technology extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'icon',
        'lang',
        'technology_section_id',
        'article_id',
    ];
    
    /**
     * Get the section that owns the technology.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(TechnologySection::class, 'technology_section_id');
    }
    
    /**
     * Get the related article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
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
    
    /**
     * Scope a query to filter by section.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $sectionId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySection($query, $sectionId)
    {
        return $query->where('technology_section_id', $sectionId);
    }
}
