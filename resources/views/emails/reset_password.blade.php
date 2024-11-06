<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
</style>
<style>
    .screen {
        padding: 40px;
        padding-top: 30px;
    }

    .logo {
        position: relative;
        float: left;
        width: 100%;
    }

    .logo img {
        width: 150px;
        height: 60px;
    }

    .content {
        padding-top: 55px;
        text-align: center;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .content img {
        padding-top: 70px;
    }

    .content p {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        text-align: left;
        margin-top: 72px;
    }

    .content .header {
        font-family: 'Poppins', sans-serif;
        font-size: 36px;
        text-align: center;
    }

    .button {
        background-color: #653E1D;
        display: inline-block;
        text-decoration: none;
        color: #DAD2CA;
        font-size: 18px;
        width: 100%;
        padding: 15px 28px;
        border-radius: 10px;
        margin: 160px auto 10px auto;
    }
</style>

<body>
    <div class="screen">
        <div class="logo">
            <img src="https://kartunikah.com/assets/img/logo-kartunikah.png" alt="logo">
        </div>
        <div class="content">
            <p class="header">Halo, {{ $user['name'] }}</p>
            <img src="{{ asset('/img/forgot_password.png') }}">

            <p>Jangan Khawatir <br>
                Lanjutkan untuk membuat password baru
            </p>

            <a href="{{ url('reset_password', $token) }}" class="button">Reset Password</a>
        </div>
    </div>
</body>

</html>
