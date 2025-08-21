@extends('admin.layouts.master')
@section('page_content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Area</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('area-create')
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                        data-action="{{ route('admin.area.store') }}" data-target="#formModalAdd">
                        Tambah
                    </button>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Area</h1>
    </div>

    {{-- MODAL ADD --}}
    <div class="modal fade" id="formModalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="" class="card-body" id="formAreaAdd">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name Area</label>
                                    <input type="text" class="form-control" name="name" placeholder=""
                                        value="{{ @$edit_mode ? $detail->name : old('name') }}" required>
                                    @error('name')
                                        <label id="name-error" class="text-danger pl-3"
                                            for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Countries</label>
                                    <select name="country_id" class="form-control @error('country_id') is-invalid @enderror"
                                        required>
                                        <option value=""> -- Contries -- </option>
                                        @foreach ($countrie as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                        @error('country')
                                            <label id="country-error" class="text-danger pl-3"
                                                for="country">{{ $message }}</label>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="formModalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="" class="card-body" id="formAreaEdit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @if (@$edit_mode)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name Area</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        placeholder="Insert your area" value="{{ old('name') }}" required>
                                    @error('name')
                                        <label id="name-error" class="text-danger pl-3"
                                            for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Countries</label>
                                    <select name="country_id" id="editArea"
                                        class="form-control @error('country_id') is-invalid @enderror" required>
                                        <option value=""> -- Countries -- </option>
                                        @if (@$edit_mode)
                                            @foreach ($area as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $area->country_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($countrie as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                        @error('area')
                                            <label id="area-error" class="text-danger pl-3"
                                                for="area">{{ $message }}</label>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="editmethod" name="_method" value="">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal DELETE -->
    <div id="formModalDanger"></div>
    <div class="modal fade" id="formModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST"class="d-inline" id="formAreaDelete">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peringatan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda ingin menghapus data <b id="namaVilla"></b>
                        ?
                    </div>
                    <div class="modal-footer">
                        <button id="validasi_btn" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="modal fade" id="formModalDanger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST"class="d-inline" id="formAreaDelete">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            WARNINGa <b id="namaVilla"></b>
                            ?
                        </div>
                        <div class="modal-footer">
                            <button id="validasi_btn" type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Area</h6>
                        @can('area-create')
                            {{-- <p><a href="{{ route('admin.area.store') }}" class="btn btn-primary ">Tambah</a></p> --}}
                            <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                                data-action="{{ route('admin.area.store') }}" data-target="#formModalAdd">
                                Tambah
                            </button>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Countries</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($area as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->countries->name ?? 'N/A' }}</td>
                                        <td>
                                            @can('area-edit')
                                                <button type="button" class="btn btn-sm btn-outline-success edit"
                                                    data-toggle="modal" data-target="#formModalEdit"
                                                    data-action="{{ route('admin.area.update', $item->id) }}"
                                                    data-id="{{ $item->id }}">Edit</button>
                                            @endcan
                                            @can('area-delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger cek-data"
                                                    data-toggle="modal" data-id="{{ $item->id }}"
                                                    data-action="{{ route('admin.area.destroy', $item->id) }}">
                                                    Delete
                                                </button>
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
    <style>
        .val_danger {
            color: red;
            text-align: center
        }

        .val_success {
            display: none
        }
    </style>
@endsection
@section('include-js')
    <script>
        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let action = $(this).data('action');
            // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
            $.ajax({
                url: "area/edit/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    // return ;
                    $('#editName').val(data.area.name);
                    $('#editArea option[value="' + data.area.country_id + '"]').prop('selected',
                        true);
                    $('#editmethod').val('PUT');
                    $('#formAreaEdit').attr('action', action);
                }
            })
        });
        $(document).on('click', '.cek-data', function() {
            let id = $(this).data('id');
            let action = $(this).data('action');
            console.log(id);
            // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
            $.ajax({
                url: "area/cek_data/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    if (data.validasi == true) {
                        console.log('kosong');
                        // $("#validasi").empty();
                        $("#formModalDelete").modal('show');
                        $("#formModalDanger").empty();
                    } else {
                        $("#formModalDanger").html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<strong>Data Area : ' + data.area.name +
                            '</strong> has derivatives, please delete the data first' +
                            '<ol>' + data.villa +
                            '<li>Location</li>' +
                            '</ol>' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>'
                        );
                        $("#formModalDelete").modal('hide');
                        // $("#validasi").empty();
                        console.log('tidak');
                    }
                    // return ;
                    $('#namaVilla').html(data.villa.name);
                    $('#editmethod').val('PUT');
                    $('#formAreaDelete').attr('action', action);
                }
            })
        });
        $(document).on('click', '#add', function() {
            var html = "";
            let id = $(this).data('id');
            let action = $(this).data('action');
            // console.log(action);
            $('#ok').text('Ok');
            $('#formAreaAdd').attr('action', action);
        });
    </script>
@endsection
