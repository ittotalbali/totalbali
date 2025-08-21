@section('include-css')
    <style>
        .card-title {
            color: #fff;
            font-weight: 400;
            font-size: 18px;
        }

        .col-auto {
            margin-top: -10px;
        }

        .jumlah_p {
            font-size: 18px;
            font-weight: 500;
            color: white;
            margin-top: -10px;
        }

        .jumlah {
            font-size: 38px;
            font-weight: 500;
            color: #59626A;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .ukuran {
            font-size: 40px;
            color: #59626A;
            text-shadow: 1px 1px 1px rgb(44, 44, 44);
            /* font-size: 1.5em; */
        }

        .card-title {
            color: #59626A;
        }
    </style>
@endsection
@extends('admin.layouts.master')
@section('page_content')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <iframe src="{{ route('maps') }}" frameborder="0" width="100%" height="500px"></iframe>
            </div>
        </div>
@endsection
@section('include-js')
@endsection
