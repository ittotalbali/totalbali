@extends('admin.layouts.master')
@section('page_content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Countries</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('country-create')
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                        data-action="{{ route('admin.countries.store') }}" data-target="#formModalAdd">
                        Tambah
                    </button>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Countries</h1>
    </div>

    {{-- MODAL ADD --}}
    <div class="modal fade" id="formModalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="" class="card-body" id="formCountrieAdd">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Country</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Name Country</label>
                                    <input type="text" class="form-control" name="name" placeholder=""
                                        value="{{ @$edit_mode ? $detail->name : old('name') }}" required>
                                    @error('name')
                                        <label id="name-error" class="text-danger pl-3"
                                            for="name">{{ $message }}</label>
                                    @enderror
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
            <form method="POST" action="" class="card-body" id="formCountrieEdit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Country</h5>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Name Country</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        placeholder="Insert your countrie" value="{{ old('name') }}" required>
                                    @error('name')
                                        <label id="name-error" class="text-danger pl-3"
                                            for="name">{{ $message }}</label>
                                    @enderror
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

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Countries</h6>
                        @can('country-create')
                            <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                                data-action="{{ route('admin.countries.store') }}" data-target="#formModalAdd">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($countries as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @can('country-edit')
                                                <button type="button" class="btn btn-sm btn-outline-success edit"
                                                    data-toggle="modal" data-target="#formModalEdit"
                                                    data-action="{{ route('admin.countries.update', $item->id) }}"
                                                    data-id="{{ $item->id }}">Edit</button>
                                            @endcan
                                            @can('country-delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                    Delete
                                                </button>
                                            @endcan

                                            <!-- Modal -->
                                            <form action="{{ route('admin.countries.destroy', $item->id) }}"
                                                method="POST"class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda ingin menghapus data <b>{{ $item->name }}</b>
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
@section('include-js')
    <script>
        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let action = $(this).data('action');
            // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
            $.ajax({
                url: "countries/edit/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    // return ;
                    $('#editName').val(data.countries.name);
                    $('#editmethod').val('PUT');
                    $('#formCountrieEdit').attr('action', action);
                }
            })
        });
        $(document).on('click', '#add', function() {
            var html = "";
            let id = $(this).data('id');
            let action = $(this).data('action');
            // console.log(action);
            $('#ok').text('Ok');
            $('#formCountrieAdd').attr('action', action);
        });
    </script>
@endsection
