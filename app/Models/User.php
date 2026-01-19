<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope a query to only include superadmins.
     */
    public function scopeSuperadmin(Builder $query): Builder
    {
        return $query->where('role', 'Superadmin');
    }

    /**
     * Scope a query to only include editors.
     */
    public function scopeEditor(Builder $query): Builder
    {
        return $query->where('role', 'Editor');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if user is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'Aktif';
    }

    /**
     * Check if user is superadmin.
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'Superadmin';
    }

    /**
     * Check if user is editor.
     */
    public function isEditor(): bool
    {
        return $this->role === 'Editor';
    }
}
