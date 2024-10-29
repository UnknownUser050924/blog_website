<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'post_id']; // Include post_id for the relationship

    public function post()
    {
        return $this->belongsTo(Post::class); // Define the inverse relationship
    }
}
