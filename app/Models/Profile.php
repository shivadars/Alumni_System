<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'department',
        'year',
        'graduation_year',
        'roll_number',
        'company',
        'skills',
        'bio',
        'profile_picture',
        'phone',
        'linkedin_url',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
