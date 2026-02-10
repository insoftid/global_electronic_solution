<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioVariantImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_variant_id',
        'media_type',
        'media_path',
        'image_path',
        'caption',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(PortfolioVariant::class, 'portfolio_variant_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }
}
