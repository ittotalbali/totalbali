@extends('admin.layouts.master')
@section('page_content')
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script>
        $(document).ready(function() {
            ajaxRequest.delete({
                url: '/admin/villa-management/rate/delete',
                data: {
                    rate_id: 21,
                    villa_id: 1,
                    details: 'testupdate',
                    type: 'testupdate',
                    start_date: '2021-01-01',
                    end_date: '2021-01-01',
                    price: 100,
                    total_bedroom: 1,
                    currency: 'IDR',
                },
                successCallback: res => {
                    console.log(res);
                },
                errorCallback: err => {
                    console.log(err.responseJSON);
                }
            })
        });
    </script>
@endsection
