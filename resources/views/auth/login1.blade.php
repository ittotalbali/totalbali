<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <title>{{ $page_title }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/floating-labels/floating-labels.css" rel="stylesheet">
</head>

<body>
    <form class="form-signin" method="POST" action="{{ route('proses_login') }}">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="{{ asset('img/icon.png') }}" alt="" width="60%">
            <h1 class="h3 mb-3 font-weight-normal">Login ADMIN</h1>
            @include('admin.layouts.alert')
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus
                name="email">
            <label for="inputEmail">Email</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required
                name="password">
            <label for="inputPassword">Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a href="{{ route('register') }}">Daftar</a>
        <a class="float-right" href="{{ route('forgot_password') }}">Lupa Password ?</a>
        <!-- <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p> -->
    </form>
</body>

</html>
