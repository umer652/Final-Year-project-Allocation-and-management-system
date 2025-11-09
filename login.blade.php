<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FYP Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("{{ asset('images/nuimg.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            text-align: center;
        }

        .header img {
            margin-right: 15px;
            border: 1px solid white;
            border-radius: 50%;
            width: 90px;
        }

        .header .title h2 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
            text-align: left;
            color: #fff;
        }

        .header .title h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }

        /* Login Box */
        .login-container {
            background: rgba(255, 255, 255, 0.7); /* Increased transparency */
            border-radius: 15px;
            padding: 40px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
            /* backdrop-filter: blur(6px); Soft blur for glass effect */
        }

        .login-container h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #0f1b5c;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            font-weight: bold;
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
            color: #0f1b5c;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 2px solid #333;
            outline: none;
            background: rgba(255, 255, 255, 0.1);
            color: #000;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle span {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
        }

        .login-btn {
            background: #0f1b5c;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 30px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: #1c2d80;
        }

        /* Error messages */
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60">
        <div class="title">
            <h2>FYP Tracker</h2>
            <h3>Northern University, Nowshera</h3>
        </div>
    </div>

    <!-- Login Box -->
    <div class="login-container">
        <h2>Login</h2>

        @if (isset($errors) && $errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="input-group">
                <label for="username">UserName</label>
                <input type="text" id="username" name="username" placeholder="FYP Tracker" value="{{ old('username') }}" required>
            </div>

            <div class="input-group password-toggle">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="XXXXXXXXX" required>
                <span onclick="togglePassword()">👁</span>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            password.type = password.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
