<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'admin_notes',
        'ip_address',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'Baru');
    }

    /**
     * Scope a query to only include read messages.
     */
    public function scopeRead(Builder $query): Builder
    {
        return $query->where('status', 'Dibaca');
    }

    /**
     * Scope a query to only include replied messages.
     */
    public function scopeReplied(Builder $query): Builder
    {
        return $query->where('status', 'Dibalas');
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to order by latest first.
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Mark message as read.
     */
    public function markAsRead(): bool
    {
        return $this->update(['status' => 'Dibaca']);
    }

    /**
     * Mark message as replied.
     */
    public function markAsReplied(): bool
    {
        return $this->update(['status' => 'Dibalas']);
    }

    /**
     * Mark message as unread.
     */
    public function markAsUnread(): bool
    {
        return $this->update(['status' => 'Baru']);
    }

    /**
     * Check if message is unread.
     */
    public function isUnread(): bool
    {
        return $this->status === 'Baru';
    }

    /**
     * Check if message is read.
     */
    public function isRead(): bool
    {
        return $this->status === 'Dibaca';
    }

    /**
     * Check if message is replied.
     */
    public function isReplied(): bool
    {
        return $this->status === 'Dibalas';
    }
}
