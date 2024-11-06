@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Services</h1>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Service</h6>
                        {{-- @can('villa-create') --}}
                            <a class="btn btn-primary" href="{{ route('admin.service.create') }}">
                                Tambah
                            </a>
                        {{-- @endcan --}}
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($services as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                            class="img-fluid" width="100px">
                                        </td>
                                        <td>
                                            {{-- @can('villa-edit') --}}
                                                <a href="{{ route('admin.service.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-success edit-btn">
                                                    Edit
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('villa-delete') --}}
                                                <button type="submit" class="btn btn-sm btn-outline-danger show_confirm"
                                                    title='Delete'>Delete</button>
                                                <input type="hidden" class="delete-id" value="{{ $item->id }}">
                                            {{-- @endcan --}}
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

    @include('admin.currency.modals.add-currency')
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
    <script>
        $('.show_confirm').click(function(event) {
            event.preventDefault();

            const deletedId = $(this).next().val();
            const url = '/admin/service/delete';

            swal({
                title: 'Anda yakin mau mengahapus data ini?',
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
                    ajaxRequest.post({
                        url: url,
                        data: {
                            service_id: deletedId,
                        },
                        successCallback: res => {
                            liveToast.show('Service berhasil dihapus');

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    });
                }
            });
        });
    </script>
@endsection
