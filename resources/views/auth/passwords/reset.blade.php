<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #495057;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #495057;
            text-align: left;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
            margin-top: 5px;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #80bdff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .info-text {
            color: #6c757d;
            font-size: 14px;
            margin-top: 20px;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 100px; /* Location of the box */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 300px; /* Could be more or less, depending on screen size */
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.update') }}" onsubmit="showModal(event)">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter new password" required>
            
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password" required>
            
            <button type="submit">Reset Password</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Password is done reset.</p>
            <button class="modal-button" onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <script>
        function showModal(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            document.getElementById("myModal").style.display = "block"; // Show the modal
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none"; // Hide the modal
        }

        function redirectToLogin() {
            window.location.href = '{{ route('login') }}'; // Redirect to login page
        }

        // Close the modal when clicking anywhere outside of the modal content
        window.onclick = function(event) {
            const modal = document.getElementById("myModal");
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
