<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'location', 'event_date', 'image'];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees')->withTimestamps();
    }

    public function getImageUrl()
    {
        if (!$this->image) return null;
        return (str_starts_with($this->image, 'http')) ? $this->image : \Illuminate\Support\Facades\Storage::disk('supabase')->url($this->image);
    }
}
