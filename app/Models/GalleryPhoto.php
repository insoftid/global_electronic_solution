<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slot_key',
        'label',
        'image_path',
        'caption',
        'placement_description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Static Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Get photo by slot key.
     */
    public static function getBySlot(string $slotKey): ?self
    {
        return static::where('slot_key', $slotKey)->first();
    }

    /**
     * Get all photos indexed by slot key.
     */
    public static function allBySlot(): \Illuminate\Database\Eloquent\Collection
    {
        return static::all()->keyBy('slot_key');
    }

    /**
     * Update or create photo for a slot.
     */
    public static function setSlot(string $slotKey, array $attributes): self
    {
        return static::updateOrCreate(
            ['slot_key' => $slotKey],
            $attributes
        );
    }
}
