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
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.update') }}">
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
</body>
</html>
