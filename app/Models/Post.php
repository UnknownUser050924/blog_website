<?php

namespace App\Models;

use App\Models\Image; // Ensure this is included at the top of your Post.php file
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    // Define the relationship with images if needed
    public function images()
    {
        return $this->hasMany(Image::class); // Make sure to create an Image model if using this
    }
}
