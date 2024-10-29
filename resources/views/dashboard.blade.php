<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        h2 {
            color: #555;
        }

        p {
            font-size: 16px;
        }

        a {
            text-decoration: none;
            color: #3490dc;
            transition: color 0.3s;
        }

        a:hover {
            color: #1d68a7;
        }

        .post-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
        }

        button {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #cc1f24;
        }

        .post-image {
            max-width: 50%; /* Adjusted to make the image smaller */
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        .no-image {
            width: 100%;
            height: 200px;
            background-color: #e2e2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            color: #999;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Welcome, {{ auth()->check() ? auth()->user()->name : 'Guest' }}!</p>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>    

    <h2>Your Posts</h2>
    <a href="{{ route('posts.create') }}">Add New Post</a>

    <!-- Loop through user posts -->
    @foreach ($posts as $post)
        <div class="post-container">
            <h3>{{ $post->title }}</h3>
            <!-- Check if the post has images -->
            @if($post->images->isNotEmpty())
                <img src="{{ asset('storage/images/' . $post->images->first()->filename) }}" alt="Post Image" class="post-image">
            @else
                <div class="no-image">No image available</div>
            @endif
            <div class="post-actions">
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            <a href="{{ route('posts.show', $post->id) }}" style="display: block; margin-top: 10px; text-align: center;">View More</a>
        </div>
    @endforeach
</body>
</html>
