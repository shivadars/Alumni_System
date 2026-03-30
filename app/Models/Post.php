<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category', 'user_id', 'department', 'image', 'video'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getImageUrl()
    {
        if (!$this->image) return null;
        return (str_starts_with($this->image, 'http')) ? $this->image : \Illuminate\Support\Facades\Storage::disk('supabase')->url($this->image);
    }

    public function getVideoUrl()
    {
        if (!$this->video) return null;
        return (str_starts_with($this->video, 'http')) ? $this->video : \Illuminate\Support\Facades\Storage::disk('supabase')->url($this->video);
    }
}
