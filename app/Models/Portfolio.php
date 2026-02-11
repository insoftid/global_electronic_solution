<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'subtitle',
        'slug',
        'description',
        'detail',
        'thumbnail',
        'youtube_url',
        'project_date',
        'is_featured',
        'display_order',
        'is_active',
        // Project metrics/statistics
        'efficiency_increase',
        'waste_reduction',
        'roi_months',
        'downtime_reduction',
        'quality_rate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'project_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the category that owns the portfolio.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The tags that belong to the portfolio.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Variants belonging to this portfolio.
     */
    public function variants(): HasMany
    {
        return $this->hasMany(PortfolioVariant::class)->orderBy('display_order');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include active portfolios.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured portfolios.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by display_order and created_at.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderByDesc('created_at');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeInCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get YouTube embed ID from URL.
     */
    public function getYoutubeEmbedIdAttribute(): ?string
    {
        if (!$this->youtube_url) {
            return null;
        }

        preg_match(
            '/(?:v=|v\/|embed\/|youtu\.be\/|watch\?v=|&v=)([A-Za-z0-9_-]{11})/',
            $this->youtube_url,
            $matches
        );

        return $matches[1] ?? null;
    }

    /**
     * Get YouTube embed URL.
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        $embedId = $this->youtube_embed_id;
        return $embedId ? "https://www.youtube.com/embed/{$embedId}" : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Boot Methods
    |--------------------------------------------------------------------------
    */

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Portfolio $portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });

        static::updating(function (Portfolio $portfolio) {
            if ($portfolio->isDirty('title') && !$portfolio->isDirty('slug')) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }
}
