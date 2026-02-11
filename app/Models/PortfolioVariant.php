<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PortfolioVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'name',
        'slug',
        'description',
        'thumbnail_image',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * The portfolio this variant belongs to.
     */
    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    /**
     * Images belonging to this variant.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PortfolioVariantImage::class)->orderBy('display_order');
    }

    /** Scope active variants. */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** Scope order. */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderByDesc('created_at');
    }

    protected static function booted(): void
    {
        static::creating(function (PortfolioVariant $variant) {
            if (empty($variant->slug)) {
                $variant->slug = Str::slug($variant->name);
            }
        });

        static::updating(function (PortfolioVariant $variant) {
            if ($variant->isDirty('name') && !$variant->isDirty('slug')) {
                $variant->slug = Str::slug($variant->name);
            }
        });
    }
}
