<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Styling similar to dashboard */
        .post-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
        .post-image {
            max-width: 150px;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
        .view-more {
            color: #3490dc;
            text-decoration: none;
        }
        .view-more:hover {
            color: #1d68a7;
        }
        .login-button-container {
            text-align: center;
            margin-top: 20px;
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
    <h1>Published Posts</h1>

    <!-- Display posts -->
    @foreach ($posts as $post)
        <div class="post-container">
            <h3>{{ $post->title }}</h3>
            @if($post->images->isNotEmpty())
                <img src="{{ asset('storage/images/' . $post->images->first()->filename) }}" alt="Post Image" class="post-image">
            @else
                <div class="no-image">No image available</div>
            @endif
            <p>{{ Str::limit($post->content, 100) }}</p>
            <a href="{{ route('shows', $post->id) }}" class="view-more">View More</a>
        </div>
    @endforeach

    <!-- Login button below Published Posts -->
    @if(!auth()->check())
        <div class="login-button-container">
            <a href="{{ route('login') }}" class="login-button">Login</a>
        </div>
    @endif
</body>
</html>
