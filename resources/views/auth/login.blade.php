<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #343a40;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: left;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #495057;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }

        input[type="email"],
        input[type="password"] {
            width: 92%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #80bdff;
            outline: none;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
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
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 10px;
            font-weight: bold;
        }

        .additional-links {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
        }

        .additional-links a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .additional-links a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email', request()->cookie('email')) }}" required>            
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password" value="{{ old('password', isset($_COOKIE['password']) ? $_COOKIE['password'] : '') }}" required>
            </div>
            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit">Login</button>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
        </form>
        <div class="additional-links">
            <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</body>
</html>
