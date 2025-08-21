<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/floating-labels/floating-labels.css" rel="stylesheet">
</head>

<body>
    <div class="form-signin">
        <div style="padding: 0px 40px">
            <div class="change text-center">
                <h2 class="mt-5">Ganti Password</h2>
                <form action="{{ route('update_password', ['token' => $token]) }}" method="POST">
                    @csrf
                    <div class="form-group @error('password') has-danger @enderror">
                        <input type="password" name="password" class="form-control lock input-lg mt-4"
                            placeholder="Password">
                        @error('password')
                            <label id="password-error" class="error mt-2 text-danger"
                                for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group @error('password_confirmation') has-danger @enderror">
                        <input type="password" class="form-control lock input-lg mt-4" name="password_confirmation"
                            placeholder="Confirmasi Password">
                        @error('password_confirmation')
                            <label id="password_confirmation-error" class="error mt-2 text-danger"
                                for="password_confirmation">{{ $message }}</label>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger btn-block mt-5" style="font-size: 16px">GANTI</button>
                    <br>
                </form>
                <footer class="mt-5 mb-5">
                    <div class="mt-5 mb-5"></div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
