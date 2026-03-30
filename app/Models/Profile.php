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

    public function getProfilePictureUrl()
    {
        if (filter_var($this->profile_picture, FILTER_VALIDATE_URL)) {
            return $this->profile_picture;
        }
        return $this->profile_picture ? asset('storage/' . $this->profile_picture) : null;
    }
}
