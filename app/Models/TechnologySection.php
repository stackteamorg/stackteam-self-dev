<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechnologySection extends Model
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
    ];

    /**
     * Get the technologies for this section.
     */
    public function technologies(): HasMany
    {
        return $this->hasMany(Technology::class);
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
