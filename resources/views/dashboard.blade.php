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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-icon {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #3490dc;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .profile-icon:hover .dropdown-content {
            display: block;
        }

        .profile-icon.active .dropdown-content {
            display: block;
        }

        .dropdown-content p {
            margin: 5px 0;
            font-weight: bold;
            color: #333;
        }

        .dropdown-content button {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .dropdown-content button:hover {
            background-color: #cc1f24;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        h2 {
            color: #555;
        }

        .add-post-button {
            background-color: #3490dc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-post-button:hover {
            background-color: #1d68a7;
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
            justify-content: flex-start; /* Align buttons to the left */
        }

        .edit-button, .view-more-button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px; /* Space between buttons */
        }

        .edit-button:hover, .view-more-button:hover {
            background-color: #1d68a7;
        }

        .delete-button {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #cc1f24;
        }

        .post-image {
            max-width: 50%;
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
    <div class="header">
        <h1>Dashboard</h1>
        <div class="profile-icon" onclick="toggleDropdown()">
            {{ auth()->user()->name[0] }}
            <div class="dropdown-content" id="dropdown">
                <p>{{ auth()->user()->name }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="content-header">
        <h2>Your Posts</h2>
        <a href="{{ route('posts.create') }}" class="add-post-button">Add New Post</a>
    </div>

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
                <form action="{{ route('posts.show', $post->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="view-more-button">View More</button>
                </form>
                <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="edit-button">Edit</button>
                </form>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon')) {
                const dropdown = document.getElementById('dropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
