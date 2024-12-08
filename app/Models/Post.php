<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }



    public function image()
    {
        if ($this->image) {
            return asset($this->image);
        }
        return asset('default.png');
    }
}
