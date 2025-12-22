<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'email',
        'code',
        'userType',
        'expiresAt',
    ];

    // Type casting for specific fields
    protected $casts = [
        'expiresAt' => 'datetime',
    ];

    /**
     * Check if verification code is expired
     * Code expire ho gaya hai ya nahi check karna
     */
    public function isExpired()
    {
        return now()->greaterThan($this->expiresAt);
    }

    /**
     * Scope: Get valid codes only
     * Sirf valid (non-expired) codes retrieve karna
     */
    public function scopeValid($query)
    {
        return $query->where('expiresAt', '>', now());
    }
}
