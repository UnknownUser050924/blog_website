<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #1d68a7;
        }

        .error {
            color: #e3342f;
            margin-bottom: 15px;
        }

        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        #imagePreview img {
            width: 100px;
            height: 100px;
            margin: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Create New Post</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to create this post?');">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Content</label>
        <textarea name="content" id="content" rows="5" required oninput="updateCharCount()"></textarea>
        <p id="charCount">Characters left: 500</p>

        <label for="images">Upload Images (max: 5 images, jpg, png)</label>
        <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png" required onchange="previewImages()">
        <div id="imagePreview"></div>

        <button type="submit">Create Post</button>
    </form>

    <p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>

    <script>
        const maxChars = 500;
        function updateCharCount() {
            const content = document.getElementById('content').value;
            const charCount = document.getElementById('charCount');
            charCount.innerText = `Characters left: ${maxChars - content.length}`;
        }

        function previewImages() {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = ''; // Clear previous images
            const files = document.getElementById('images').files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
</body>
</html>
