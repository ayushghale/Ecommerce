<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f2f2f2;
    }

    .form-container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        position: relative;
        overflow: hidden;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-container form {
        transition: transform 0.6s ease-in-out;
    }

    .form-container.register-form {
        transform: translateX(400px);
    }

    .form-container.login-form {
        transform: translateX(0);
    }

    .form-container.register-form .login-form {
        transform: translateX(-400px);
    }

    .form-container.register-form h2 {
        margin-bottom: 30px;
    }

    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .form-container button {
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: #ffffff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: #45a049;
    }

    .form-container .toggle-form {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 12px;
        text-decoration: underline;
        color: #666;
        cursor: pointer;
    }

    .inputDiv {
        margin-bottom: 15px;
    }

    .error {
        color: red;
    }

    .sweetErrormessage {
        position: fixed;
        height: 70px;
        top: 30px;
        right: 10px;
        background-color: #ff0000 !important;
        color: white;
        padding: 25px;
        border: 1px solid #c3e6cb;
        animation: fadeOut 4s linear forwards;
    }
</style>
{{-- start sweet Message --}}
@if (session()->has('error'))
    <div class="sweetErrormessage">
        {{ session()->get('error') }}

    </div>
@endif
{{-- end sweet Message --}}

<body>

    <div class="form-container">
        <h2>Login</h2>
        @error('error')
            <div class="error" role="alert">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <form method="POST" class="login-form" action="{{ route('admin.authenticate') }}">
            {{-- <form action="{{ route('admin.loginData') }}" method="POST" class="login-form"> --}}
            @csrf
            <div class="inputDiv">
                <input type="text" id="username" placeholder="Email" name="email" />
                @error('email')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                @if (session('email'))
                    <div class="error" role="alert">
                        <span class="text-danger">{{ session('email') }}</span>
                    </div>
                @endif
            </div>
            <div class="inputDiv">
                <input type="password" id="password" placeholder="Password" name="password" />
                @error('password')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                @if (session('password'))
                    <div class="error" role="alert">
                        <span class="text-danger">{{ session('password') }}</span>
                    </div>
                @endif
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
