<?php

namespace App\Models;

use App\Models\Image; // Ensure this is included at the top of your Post.php file
use App\Models\User; // Import the User model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    // Define the relationship with images
    public function images()
    {
        return $this->hasMany(Image::class); // Make sure to create an Image model if using this
    }

    // Define the relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class); // This will allow you to access the user who created the post
    }
}
