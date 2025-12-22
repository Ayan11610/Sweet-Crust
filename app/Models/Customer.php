<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    // Guard name for customer authentication
    protected $guard = 'customer';

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'verified',
    ];

    // Hidden fields (API responses mein nahi dikhenge)
    protected $hidden = ['password', 'remember_token'];

    // Type casting for specific fields
    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Relationship: Customer has many Orders (1:M)
     * Ek customer bohot saray orders place kar sakta hai
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customerId', 'id');
    }
}
