<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <style>
        .post-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 20px auto;
        }
        .post-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="post-container">
        <h1>{{ $post->title }}</h1>
        <p><strong>Author:</strong> {{ $post->user->name }}</p>
        <p><strong>Published on:</strong> {{ $post->created_at->format('M d, Y') }}</p>
        
        @if($post->images->isNotEmpty())
            @foreach($post->images as $image)
                <img src="{{ asset('storage/images/' . $image->filename) }}" alt="Post Image" class="post-image">
            @endforeach
        @else
            <p>No images available</p>
        @endif

        <p>{{ $post->content }}</p>
        <a href="{{ route('home') }}">Back to Home</a>
    </div>
</body>
</html>
