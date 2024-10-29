<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .post-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 800px;
        }

        .post-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 10px 0;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        .back-button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #1d68a7;
        }
    </style>
</head>
<body>
    <div class="post-container">
        <h1>{{ $post->title }}</h1>
        <p><strong>Content:</strong> {{ $post->content }}</p> <!-- Updated content format -->
        
        <!-- Display associated images -->
        @if($post->images->isNotEmpty())
            <p><strong>Pictures:</strong></p>
            @foreach($post->images as $image)
                <img src="{{ asset('storage/images/' . $image->filename) }}" alt="Post Image" class="post-image">
            @endforeach
        @else
            <p>No images available for this post.</p>
        @endif

        <a href="{{ route('dashboard') }}" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
