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
}
