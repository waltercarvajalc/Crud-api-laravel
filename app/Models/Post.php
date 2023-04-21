<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'status', 'content', 'user_id', 'category_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->user_id = Auth::id();
        });
    }

    //relacion de uno a muchos inversa  post-user

    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos inversa  post-category

    public function category(){
        return $this->belongsTo(Category::class);
    }


}
