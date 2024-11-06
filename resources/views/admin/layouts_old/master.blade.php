<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ @$page_title ? $page_title . ' - ' . config('app.name') : config('app.name') }}</title>
    @yield('include-css')
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}

    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('basic/css/admin_main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('basic/css/admin_resp.css') }}">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css'>
    <!-- custom -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
    </script>
    <script src="https://kit.fontawesome.com/4be04670e7.js" crossorigin="anonymous"></script>

    <!-- DROPFY -->
    <link rel="stylesheet" href="{{ asset('fileupload/css/fileupload.css') }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
    {{-- style data table --}}
    @yield('dt')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.11.3/af-2.3.7/b-2.0.1/date-1.1.1/sb-1.2.2/datatables.min.css" />
    <!-- endinject -->

</head>

<body>
    @include('admin.layouts._sidebar')

    @include('admin.layouts._navbar')

    @yield('page_content')

    @include('admin.layouts._footer')


    @yield('modals')

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- core:js -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script src="{{ asset('fileupload/js/dropify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]F').attr('aria-expanded', 'false');
            });
            $('.dropify').dropify({
                messages: {
                    default: 'Drag and drop files here or click',
                    replace: 'Drag and drop or click to replace',
                    remove: 'Remove',
                    error: 'Oops, something went wrong.'
                }
            });
            $('#example').DataTable();
            $('.datatabel').DataTable();
        });
    </script>

    @yield('include-js')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.11.3/af-2.3.7/b-2.0.1/date-1.1.1/sb-1.2.2/datatables.min.js"></script>
    <!-- end custom js for this page -->

    <!-- ini js data table -->
    @yield('dt')
</body>

</html>
