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
        <div class="text-center mb-4">
            <h2 class="mt-5">Lupa Password ?</h2>
            <p class="mt-5 mb-5">Masukan e-mail yang telah anda daftarkan, <br>
                kami akan mengirim instruksi ganti password <br>
                melalui e-mail anda.</p>
            <form action="{{ route('forgot_password_process') }}" method="POST">
                @csrf
                <div class="form-group @error('email') has-danger @enderror">
                    <input type="email" name="email" class="form-control mail input-lg mt-4" placeholder='E-mail'>
                    @error('email')
                        <label id="email-error" class="error mt-2 text-danger" for="email">{{ $message }}</label>
                    @enderror
                </div>
                <button type="submit" class="btn btn-danger btn-block mt-1" style="font-size: 16px">KIRIM
                    EMAIL</button>
            </form><br>
        </div>
    </div>
</body>

</html>
