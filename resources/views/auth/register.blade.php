<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef; /* Slightly lighter background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #343a40; /* Darker text color */
        }

        .register-container {
            background-color: #fff;
            padding: 30px; /* Increased padding for better spacing */
            border-radius: 10px; /* Softer border radius */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 320px; /* Consistent width with login form */
            text-align: left;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center; /* Center the heading */
            color: #495057; /* Softer heading color */
        }

        .form-group {
            margin-bottom: 20px; /* Increased margin for better spacing */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057; /* Softer label color */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px; /* Increased padding for better input */
            border: 1px solid #ced4da; /* Softer border color */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s; /* Smooth border transition */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #80bdff; /* Border color on focus */
            outline: none; /* Remove outline */
        }

        button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 12px; /* Increased padding for better button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s; /* Smooth background transition */
            width: 100%; /* Full-width button */
        }

        button:hover {
            background-color: #0056b3; /* Darker on hover */
        }

        .error-message {
            color: #dc3545; /* Bootstrap danger color */
            margin-top: 10px;
            font-weight: bold;
        }

        p {
            margin-top: 20px;
            text-align: center;
            color: #6c757d; /* Secondary text color */
        }

        a {
            color: #007bff; /* Bootstrap primary color */
            text-decoration: none;
            transition: color 0.3s; /* Smooth color transition */
        }

        a:hover {
            color: #0056b3; /* Darker link color on hover */
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
            </div>
            <button type="submit">Register</button>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
        </form>
        <p>Have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</body>
</html>
