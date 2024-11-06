@extends('admin.layouts.master')
@section('page_content')
    {{-- <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Booking</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('booking-create')
                    <a href="{{ route('admin.booking.create') }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Booking</h1>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Booking</h6>
                        @can('booking-create')
                            <a href="{{ route('admin.booking.create') }}">
                                <button class="btn btn-primary">Tambah</button>
                            </a>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rate</th>
                                    <th>Villa</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Rate Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($booking as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->rate->name }}</td>
                                        <td>{{ $item->villa->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            Start : {{ date('d-m-Y', strtotime($item->start_date)) }}
                                            <br>
                                            End : {{ date('d-m-Y', strtotime($item->end_date)) }}
                                        </td>
                                        <td>
                                            Type : {{ $item->rate_type }}
                                            <br>
                                            Price : {{ $item->rate_price }}
                                            <br>
                                            Total : {{ $item->rate_total }}
                                        </td>
                                        <td>
                                            @can('booking-edit')
                                                <a href="{{ route('admin.booking.edit', ['booking' => $item->id]) }}">
                                                    <button class="btn btn-sm btn-outline-success">Edit</button>
                                                </a>
                                            @endcan
                                            @can('booking-delete')
                                                <form action="{{ route('admin.booking.destroy', ['booking' => $item->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger show_confirm"
                                                        title='Delete' data-name="{{ $item->name }}">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('include-css')
    <style type="text/css">
        .swal-modal {
            width: 300px;
            height: auto;
        }

        .swal-title {
            font-size: 18px;
        }

        .swal-footer {
            text-align: center;
        }
    </style>
@endsection
@section('include-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: 'Anda yakin mau mengahapus data "' + name + '" ?',
                    dangerMode: true,
                    buttons: {
                        confirm: {
                            text: 'Yes'
                        },
                        cancel: 'Cancel'

                    },
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
