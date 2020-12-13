<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function photo() {
        return $this->photo
            ? asset('storage/blog-photos/'.$this->photo )
            : ('https://ahrefs.com/blog/wp-content/uploads/2019/03/blog-how-to-write-a-blog-post-400x200.png');
    }

    public function hasPhoto() {
        return !!$this->photo;
    }

    public function slug() {
        return route('posts.show', $this->slug);
    }
}
