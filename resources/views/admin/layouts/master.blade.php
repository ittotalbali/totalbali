<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-type" content="application/x-www-form-urlencoded; charset=UTF-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>{{ @$page_title ? $page_title . ' - ' . config('app.name') : config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('admin/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/demo_1/style.css') }}">
    <link rel="icon" type="image/ico" href="{{ asset('img/icon.png') }}">
    {{-- Data Table --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <script src="https://kit.fontawesome.com/4be04670e7.js" crossorigin="anonymous"></script>
    @yield('include-css')
    @yield('dt')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .custom-1-switch {
            position: relative;
            display: inline-block;
            width: 45px;
            height: 20px;
        }

        .custom-1-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .custom-1-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .custom-1-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .custom-1-slider {
            background-color: #1B84FF;
        }

        input:focus + .custom-1-slider {
            box-shadow: 0 0 1px #3f3f3f;
        }

        input:checked + .custom-1-slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .custom-1-slider.round {
            border-radius: 34px;
        }

        .custom-1-slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body class="sidebar-dark">

    <div class="main-wrapper">
        @include('admin.layouts._sidebar')

        <div class="page-wrapper">
            @include('admin.layouts._navbar')

            <div class="page-content">
                <div class="position-fixed p-3" style="z-index: 5; right: 0; top: 50px;">
                    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                      <div class="toast-body">
                        <span id="toastMessage">This is Live Toast</span>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
                </div>

                @yield('page_content')
            </div>

            @include('admin.layouts._footer')
        </div>

    </div>

    @yield('modals')

    <!-- core:js -->
    <script src="{{ asset('admin/vendors/core/core.js') }}"></script>
    <script src="{{ asset('admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>

    <!-- plugin js for this page -->
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/js/data-table.js')}}"></script>

    <!-- custom js -->
    <script>
        // ajaxRequest
        const ajaxRequest = {
            get: function ({
                url,
                data,
                successCallback = null,
                errorCallback = null
            }) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'GET',
                    data: data,
                    dataType: 'json',
                    async: true,
                    success: successCallback,
                    error: errorCallback
                });
            },
            
            post: function ({
                url,
                data,
                successCallback = null,
                errorCallback = null
            }) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: true,
                    success: successCallback,
                    error: errorCallback
                });
            },

            put: function ({
                url,
                data,
                successCallback = null,
                errorCallback = null
            }) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'PUT',
                    data: data,
                    dataType: 'json',
                    async: true,
                    success: successCallback,
                    error: errorCallback
                });
            },

            delete: function ({
                url,
                data,
                successCallback = null,
                errorCallback = null
            }) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE',
                    data: data,
                    dataType: 'json',
                    async: true,
                    success: successCallback,
                    error: errorCallback
                });
            }
        }

        // liveToast
        const toastEl = document.getElementById('liveToast');
        const liveToast = {
            show: (message) => {
                toastEl.querySelector('#toastMessage').innerText = message;
                $(toastEl).toast('show');

                setTimeout(clearMessage, 3000, toastEl);
            }
        }

        function clearMessage(toastEl) {
            toastEl.querySelector('#toastMessage').innerText = '';
        }
    </script>

    @yield('include-js')
    @yield('dt')
</body>

</html>
