<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'blog';
    
    protected $fillable = [
        'title',
        'content',
        'author_id'
    ];

        // foregin key
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    //relation between post and user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relation between  post and Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}
