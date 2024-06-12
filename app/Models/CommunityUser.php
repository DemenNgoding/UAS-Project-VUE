<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    use HasFactory;

    const UPDATE_AT = null;

    protected $fillable = [
        'status', 
        'role', 
        'user_id', 
        'community_id',
        'created_by',
    ];
}
