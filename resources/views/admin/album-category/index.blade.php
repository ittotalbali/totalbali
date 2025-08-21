@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Album Categories</h1>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Album Category</h6>
                        {{-- @can('villa-create') --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-album-category">
                                Tambah
                            </button>
                        {{-- @endcan --}}
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($album_categories as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{-- @can('villa-edit') --}}
                                                <button class="btn btn-sm btn-outline-success edit-btn">Edit</button>
                                                <input type="hidden" class="edit-id" value="{{ $item->id }}">
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

    @include('admin.album-category.modals.add-album-category')
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

            const deleted_id = $(this).next().val();
            const url = '/admin/album-category/delete';

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
                            album_category_id: deleted_id,
                        },
                        successCallback: res => {
                            liveToast.show('Album category berhasil dihapus');

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    });
                }
            });
        });

        $(document).ready(() => {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', event => {
                    const edit_id = btn.parentElement.querySelector('.edit-id').value;

                    ajaxRequest.get({
                        url: '/admin/album-category/get',
                        data: {
                            album_category_id: edit_id
                        },
                        successCallback: res => {
                            initEditModal(res.data);
                        }
                    })
                });
            });

            $('#add-album-category').on('hidden.bs.modal', function(e) {
                resetEditModal();
            });

            $('#submitBtn').click(function () {
                const album_category_id = $('input[name="id"]').val();
                const name = $('input[name="name"]').val();

                const store_url = '/admin/album-category/store';
                const update_url = '/admin/album-category/update';

                const url = album_category_id ? update_url : store_url;

                ajaxRequest.post({
                    url: url,
                    data: {
                        album_category_id: album_category_id,
                        name: name,
                    },
                    successCallback: res => {
                        $('#add-album-category').modal('hide');
                        liveToast.show('Album category berhasil disimpan');

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                });
            });
        });

        function initEditModal(data) {
            $('#add-album-category').modal('show');
            $('#add-album-category').find('.modal-title').text('Edit Album Category');

            $('#add-album-category').find('input[name="id"]').val(data.id);
            $('#add-album-category').find('input[name="name"]').val(data.name);
        }

        function resetEditModal() {
            $('#add-album-category').find('.modal-title').text('Add Album Category');
            $('#add-album-category').find('input[name="id"]').val('');
            $('#add-album-category').find('input[name="name"]').val('');
        }
    </script>
@endsection
