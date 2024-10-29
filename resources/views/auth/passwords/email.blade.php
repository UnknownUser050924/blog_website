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
            margin-bottom: 10px;
            font-weight: bold;
            color: #495057;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus {
            border-color: #80bdff;
            outline: none;
        }

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            flex: 1;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            border: none;
            color: white;
        }

        .submit-btn {
            background-color: #007bff;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            background-color: #6c757d;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
        }

        .info-text {
            color: #6c757d;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            
            <div class="button-container">
                <button type="submit" class="submit-btn">Send Password Reset Link</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='{{ route('login') }}'">Cancel</button>
            </div>
        </form>
        <p class="info-text">Please enter your registered email address to receive the password reset link.</p>
    </div>
</body>
</html>
