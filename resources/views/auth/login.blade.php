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
                        <form class="form-signin" method="POST" action="{{ route('proses_login') }}">
                            @csrf
                            <div class="card">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="{{ route('home') }}" class="noble-ui-logo d-block mb-2"><span>Total</span>
                                        Bali</a>
                                    @include('admin.layouts.alert')
                                    <h5 class="text-muted font-weight-normal mb-4">Selamat Datang! Silahkan Login</h5>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                id="exampleInputEmail1" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                id="exampleInputPassword1" autocomplete="current-password"
                                                placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit"
                                                class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
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
