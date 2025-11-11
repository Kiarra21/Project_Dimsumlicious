<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * Get users with this role
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Check if role has specific permission
     */
    public function hasPermission(string $permission): bool
    {
        if (!$this->permissions) {
            return false;
        }
        
        return in_array($permission, $this->permissions);
    }

    /**
     * Role constants
     */
    const ADMIN = 'admin';
    const STAFF = 'staff';
    const USER = 'user';
}
