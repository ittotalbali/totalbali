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
    <form method="post" class="form-signin" method="post" action="{{ route('proses_register') }}">
        @csrf
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
            @include('admin.layouts.alert')
        </div>

        <div class="form-group">
            <label for="inputName">Nama</label>
            <input type="text" id="inputName" class="form-control" placeholder="Insert Username" required autofocus
                name="name">
            @error('name')
                <label id="name-error" class="error mt-2 text-danger" for="name">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputNohp">No Hp</label>
            <input type="text" id="inputNohp" class="form-control" placeholder="Insert No Hp" required autofocus
                name="no_hp">
            @error('no_hp')
                <label id="no_hp-error" class="error mt-2 text-danger" for="no_hp">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Insert Email" required autofocus
                name="email">
            @error('email')
                <label id="email-error" class="error mt-2 text-danger" for="email">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Insert Password" required
                name="password">
            @error('password')
                <label id="password-error" class="error mt-2 text-danger" for="password">{{ $message }}</label>
            @enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
        <a href="{{ route('login') }}">Login</a>
        <!-- <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p> -->
    </form>
</body>

</html>
