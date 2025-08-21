@extends('admin.layouts.master')
@section('page_content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Role</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('role-create')
                    <a href="{{ route('admin.role.create') }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Role</h1>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Role</h6>
                        @can('user-create')
                            <a href="{{ route('admin.role.create') }}">
                                <button class="btn btn-primary">Tambah</button>
                            </a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @can('role-edit')
                                                <a href="{{ route('admin.role.edit', ['role' => $item->id]) }}">
                                                    <button class="btn btn-sm btn-outline-success">Edit</button>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                                <form action="{{ route('admin.role.destroy', ['role' => $item->id]) }}"
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
