<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
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
        /* margin-bottom: 15px; */
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

    .error {
        color: red;
    }

    .inputText {
        margin-bottom: 15px;
    }
</style>

<body>

    <div class="form-container">
        {{-- <form action="{{ route('admin.registeData') }}" method="POST"> --}}
        <form method="POST">
            @csrf
            <h2>Register</h2>
            <div class="inputText">
                <input type="text" id="full_name" placeholder="Full Name" name="full_name" />
                @error('full_name')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="inputText">
                <input type="text" id="contact_number" placeholder="Contact Number" name="contact_number" />
                @error('contact_number')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="inputText">
                <input type="email" id="email" placeholder="Email" name="email" autocomplete="off" />
                @error('email')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="inputText">
                <input type="password" id="username" placeholder="Pssword" name="password" autocomplete="off" />
                @error('password')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="inputText">
                <input type="password" id="password" placeholder=" Confirm Password" name="confirm_Password"
                    autocomplete="off" />
                @error('confirm_Password')
                    <div class="error" role="alert">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>
