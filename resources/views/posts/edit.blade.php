<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
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
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #1d68a7;
        }

        .error {
            color: #e3342f;
            margin-bottom: 15px;
        }

        .char-count {
            margin: -10px 0 15px;
            font-size: 14px;
            color: #555;
        }

        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        #imagePreview .image-container {
            position: relative;
            margin: 5px;
        }

        #imagePreview img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }

        .trash-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            background-color: white;
            border: 1px solid #e3342f;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e3342f;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .trash-icon:hover {
            background-color: #e3342f;
            color: white;
        }

        .back-button {
            background-color: #e3342f; /* Red color for back button */
        }

        .back-button:hover {
            background-color: #cc1f24;
        }
    </style>
</head>
<body>
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>

        <label for="content">Content</label>
        <textarea name="content" id="content" rows="5" required oninput="updateCharCount()">{{ old('content', $post->content) }}</textarea>
        <p id="charCount" class="char-count">Characters left: 500</p> <!-- Character count display -->

        <label for="images">Upload New Images (Optional)</label>
        <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png" onchange="previewImages()">

        <div id="imagePreview"></div>

        <button type="submit">Update Post</button>
        <button type="button" class="back-button" onclick="window.location.href='{{ route('dashboard') }}'">Back to Dashboard</button>
    </form>

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
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('image-container');
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;

                        const trashIcon = document.createElement('div');
                        trashIcon.classList.add('trash-icon');
                        trashIcon.innerHTML = '&times;'; // Trash icon symbol
                        trashIcon.onclick = function() {
                            removeImage(i); // Remove image function
                        };

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(trashIcon);
                        preview.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        function removeImage(index) {
            const fileInput = document.getElementById('images');
            const dt = new DataTransfer();
            const files = fileInput.files;

            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }
            fileInput.files = dt.files; // Update the file input
            previewImages(); // Refresh the image preview
        }
    </script>
</body>
</html>
