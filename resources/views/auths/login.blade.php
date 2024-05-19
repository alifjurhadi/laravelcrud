<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login Dashboard</title>
</head>

<body>
    <!--  Login And Sign Up -->
    <div class="login-box">
        <div class="user">
            <i class="fas fa-user fa-2x"></i>
        </div>
        <img src="{{ asset('admin/logo.png') }}" class="profile" alt="Logo Sekolah">
        <h2>LOGIN SISWA</h2>
        <form action="/postlogin" method="POST">
            {{ csrf_field() }}
            <div class="user-box">
                <input type="email" name="email" id="email" autocomplete="off" autofocus required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Login Now
            </button>
            {{-- <button type="submit" class="button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Lupa Password
            </button> --}}
        </form>
    </div>
</body>

</html>
