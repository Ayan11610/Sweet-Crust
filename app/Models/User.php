<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'roleId', 'name', 'email', 'password', 'verified',
    ];

    // Hidden fields (API responses mein nahi dikhenge)
    protected $hidden = ['password', 'remember_token'];

    // Type casting for specific fields
    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Relationship: User belongs to Role (M:1)
     * Har user ek role se belong karta hai
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId', 'id');
    }

    /**
     * Relationship: User has many Orders (1:M)
     * Ek user (staff) bohot saray orders create kar sakta hai
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'createdBy', 'id');
    }
}
