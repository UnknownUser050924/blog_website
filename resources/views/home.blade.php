<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            display: flex;
            justify-content: space-between; /* Aligns items in a row */
            align-items: center; /* Centers items vertically */
            margin-bottom: 20px; /* Space below the title */
            color: #333;
        }

        /* Styling for the post container */
        .post-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px; /* Increased margin for more spacing */
        }

        .post-image {
            max-width: 150px;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
            margin-right: 10px; /* Space between images */
            display: inline-block; /* Align images horizontally */
        }

        .view-more {
            display: block; /* Ensure it takes up its own line */
            color: #3490dc;
            text-decoration: none;
            margin-top: 10px; /* Space above "View More" */
        }

        .view-more:hover {
            color: #1d68a7;
        }

        .login-button-container {
            text-align: right; /* Align to the right */
            margin-left: 20px; /* Space between title and button */
        }

        .login-button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #1d68a7;
        }
    </style>
</head>
<body>
    <h1>
        Homepage
        @if(!auth()->check())
            <div class="login-button-container">
                <a href="{{ route('login') }}" class="login-button">Login</a>
            </div>
        @endif
    </h1>

    <!-- Display posts -->
    @foreach ($posts as $post)
    <div class="post-container">
        <h3>{{ $post->title }}</h3>
        <p>Description: {{ $post->content }}</p>
        <p>Posted By: {{ $post->user ? $post->user->name : 'Unknown' }}</p>
        <p>Published on: {{ $post->created_at->format('F j, Y') }}</p> <!-- Format date as needed -->

        <!-- Display all associated images -->
        @if($post->images->isNotEmpty())
            <p>Pictures:</p>
            @foreach($post->images as $image)
                <img src="{{ asset('storage/images/' . $image->filename) }}" alt="Post Image" class="post-image">
            @endforeach
        @else
            <div class="no-image">No images available</div>
        @endif
    </div>
    @endforeach
</body>
</html>
