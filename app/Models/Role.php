<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Table ka naam specify karna (optional, Laravel auto-detect karta hai)
    protected $table = 'roles';

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'name',
    ];

    /**
     * Relationship: Role has many Users
     * Ek role ke paas bohot saray users ho sakte hain (1:M)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
