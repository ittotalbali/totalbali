<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="icon" type="image/ico" href="{{ asset('img/icon.png') }}">
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-6 col-xl-4 mx-auto">
                        <form method="post" class="form-signin" action="{{ route('proses_register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" id="" name="name"
                                    value="{{ old('name') }}" placeholder="Nama lengkap Anda">
                                @error('name')
                                    <label id="name-error" class="error mt-2 text-danger"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" id="" name="email"
                                    value="{{ old('email') }}" placeholder="Email Anda">
                                @error('email')
                                    <label id="email-error" class="error mt-2 text-danger"
                                        for="email">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Asal Sekolah</label>
                                <input type="text" class="form-control" id="" name="school"
                                    value="{{ old('school') }}" placeholder="Asal sekolah Anda">
                                @error('school')
                                    <label id="school-error" class="error mt-2 text-danger"
                                        for="school">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <input type="text" class="form-control" id="" name="class"
                                    value="{{ old('class') }}" placeholder="Kelas Anda">
                                @error('class')
                                    <label id="class-error" class="error mt-2 text-danger"
                                        for="class">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="" name="birth_date">
                                @error('birth_date')
                                    <label id="birth_date-error" class="error mt-2 text-danger"
                                        for="birth_date">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="password-field" name="new_password"
                                    value="{{ old('new_password') }}">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('new_password')
                                    <label id="new_password-error" class="error mt-2 text-danger"
                                        for="new_password">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password-field1"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}">
                                <span toggle="#password-field1"
                                    class="fa fa-fw fa-eye field-icon toggle-password1"></span>
                            </div>
                            @error('password_confirmation')
                                <label id="password_confirmation-error" class="error mt-2 text-danger"
                                    for="password_confirmation">{{ $message }}</label>
                            @enderror
                            <a href="{{ route('admin.countrie.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </form>
                        <br>
                        <div class="mb-5">
                            <p>Already have account? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('admin/vendors/core/core.js') }}"></script>
    <script src="{{ asset('admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
</body>

</html>
