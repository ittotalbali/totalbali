@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Currencies</h1>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Currency</h6>
                        {{-- @can('villa-create') --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCurrency">
                                Tambah
                            </button>
                        {{-- @endcan --}}
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($currencies as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->code }}</td>
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
            const url = '/admin/currency/delete';

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
                            currency_id: deletedId,
                        },
                        successCallback: res => {
                            liveToast.show('Currency berhasil dihapus');

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
                    const editId = btn.parentElement.querySelector('.edit-id').value;

                    ajaxRequest.get({
                        url: '/admin/currency/get',
                        data: {
                            currency_id: editId
                        },
                        successCallback: res => {
                            initEditModal(res.data);
                        }
                    })
                });
            });

            $('#addCurrency').on('hidden.bs.modal', function(e) {
                resetEditModal();
            });

            $('#submitBtn').click(function () {
                const currencyId = $('input[name="id"]').val();
                const code = $('input[name="code"]').val();
                const name = $('input[name="name"]').val();

                const storeUrl = '/admin/currency/store';
                const updateUrl = '/admin/currency/update';

                const url = currencyId ? updateUrl : storeUrl;

                ajaxRequest.post({
                    url: url,
                    data: {
                        currency_id: currencyId,
                        code: code,
                        name: name,
                    },
                    successCallback: res => {
                        $('#addCurrency').modal('hide');
                        liveToast.show('Currency berhasil disimpan');

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                });
            });
        });

        function initEditModal(data) {
            $('#addCurrency').modal('show');
            $('#addCurrency').find('.modal-title').text('Edit Currency');

            $('#addCurrency').find('input[name="id"]').val(data.id);
            $('#addCurrency').find('input[name="code"]').val(data.code);
            $('#addCurrency').find('input[name="name"]').val(data.name);
        }

        function resetEditModal() {
            $('#addCurrency').find('.modal-title').text('Add Currency');
            $('#addCurrency').find('input[name="id"]').val('');
            $('#addCurrency').find('input[name="code"]').val('');
            $('#addCurrency').find('input[name="name"]').val('');
        }
    </script>
@endsection
