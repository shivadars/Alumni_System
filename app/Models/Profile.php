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
        if (empty($this->profile_picture)) {
            return null;
        }

        if (filter_var($this->profile_picture, FILTER_VALIDATE_URL)) {
            return $this->profile_picture;
        }

        // Return the supabase URL for the image
        return \Illuminate\Support\Facades\Storage::disk('supabase')->url($this->profile_picture);
    }
}
