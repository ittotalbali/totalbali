@extends('admin.layouts.master')
@section('page_content')
{{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Location</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('area-create')
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                        data-action="{{ route('admin.location.store') }}" data-target="#formModalAdd">
Tambah
</button>
@endcan
</div>
</div> --}}

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h4">Location</h1>
</div>

{{-- MODAL ADD --}}
<div class="modal fade" id="formModalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="" class="card-body" id="formLocationAdd">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name Location</label>
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
                                <label for="">Location</label>
                                <select name="area_id" class="form-control @error('area_id') is-invalid @enderror"
                                    required>
                                    <option value=""> -- Location -- </option>
                                    @if (@$edit_mode)
                                    @foreach ($location as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $location->area_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                    @else
                                    @foreach ($area as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                    @error('location')
                                    <label id="location-error" class="text-danger pl-3"
                                        for="location">{{ $message }}</label>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" name="latitude" placeholder=""
                                    value="{{ @$edit_mode ? $detail->latitude : old('latitude') }}" required>
                                @error('latitude')
                                <label id="latitude-error" class="text-danger pl-3"
                                    for="latitude">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">longitude</label>
                                <input type="text" class="form-control" name="longitude" placeholder=""
                                    value="{{ @$edit_mode ? $detail->longitude : old('longitude') }}">
                                @error('longitude')
                                <label id="longitude-error" class="text-danger pl-3"
                                    for="longitude">{{ $message }}</label>
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
        <form method="POST" action="" class="card-body" id="formLocationEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Location</h5>
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
                                <label for="">Name Location</label>
                                <input type="text" class="form-control" id="editName" name="name"
                                    placeholder="Insert your location" value="{{ old('name') }}" required>
                                @error('name')
                                <label id="name-error" class="text-danger pl-3"
                                    for="name">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- THIS --}}
                            <div class="form-group">
                                <label for="">Area</label>
                                <select name="area_id" id="editLocation"
                                    class="form-control @error('area_id') is-invalid @enderror" required>
                                    <option value=""> -- Area -- </option>
                                    @if (@$edit_mode)
                                    @foreach ($area as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $area->area_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                    @else
                                    @foreach ($area as $item)
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" id="editLatitude" name="latitude"
                                    placeholder="Insert your latitude" value="{{ old('latitude') }}">
                                @error('latitude')
                                <label id="latitude-error" class="text-danger pl-3"
                                    for="latitude">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" class="form-control" id="editLongitude" name="longitude"
                                    placeholder="Insert your longitude" value="{{ old('longitude') }}">
                                @error('longitude')
                                <label id="longitude-error" class="text-danger pl-3"
                                    for="longitude">{{ $message }}</label>
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

<!-- Modal DELETE -->
<div id="formModalDanger"></div>
<div class="modal fade" id="formModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="d-inline" id="formLocationDelete">
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
                    Apakah Anda ingin menghapus data <b id="namaLocation"></b>
                    ?
                </div>
                <div class="modal-footer">
                    <button id="validasi_btn" type="submit" class="btn btn-danger">Delete</button>
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
                    <h6 class="card-title">Data Location</h6>
                    @can('area-create')
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                        data-action="{{ route('admin.location.store') }}" data-target="#formModalAdd">
                        Tambah
                    </button>
                    @endcan
                </div>

                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Area</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($location as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>{{ $item->area->name }}</td>
                                <td>
                                    @can('area-edit')
                                    <button type="button" class="btn btn-sm btn-outline-success edit"
                                        data-toggle="modal" data-target="#formModalEdit"
                                        data-action="{{ route('admin.location.update', $item->id) }}"
                                        data-id="{{ $item->id }}">Edit</button>
                                    @endcan
                                    @can('area-delete')
                                    <button type="button" class="btn btn-sm btn-outline-danger cek-data"
                                        data-toggle="modal" data-id="{{ $item->id }}"
                                        data-action="{{ route('admin.location.destroy', $item->id) }}">
                                        Delete
                                    </button>
                                    @endcan
                                    <!-- <button type="button" class="btn btn-sm btn-outline-danger cek-data"
                                                    data-toggle="modal" data-id="{{ $item->id }}"
                                                    data-action="{{ route('admin.location.destroy', $item->id) }}">
                                                    Delete
                                                </button> -->


                                    <!-- Modal -->
                                    <!-- <form action="{{ route('admin.location.destroy', $item->id) }}"
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
                                                                    class="btn btn-danger">Delete</button> -->
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
    // THIS
    $(document).on('click', '.edit', function() {
        let id = $(this).data('id');
        let action = $(this).data('action');
        // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
        $.ajax({
            url: "location/edit/" + id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log(data.location.name);
                // return ;
                $('#editName').val(data.location.name);
                $('#editLocation option[value="' + data.location.area_id + '"]').prop('selected',
                    true);
                $('#editmethod').val('PUT');
                $('#formLocationEdit').attr('action', action);
            }
        })
    });
    $(document).on('click', '.cek-data', function() {
        let id = $(this).data('id');
        let action = $(this).data('action');
        // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
        $.ajax({
            url: "location/cek_data/" + id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log(data); // Tambahkan variabel data di sini
                if (data.validasi == true) {
                    console.log('kosong');
                    // $("#validasi").empty();
                    $("#formModalDelete").modal('show');
                    $("#formModalDanger").empty();
                } else {
                    $("#formModalDanger").html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Data Area : ' + data.location.name +
                        '</strong> has derivatives, please delete the data first' +
                        '<ol>' + data.villa +
                        '<li>Sub Location</li>' +
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
                $('#namaLocation').html(data.location.name);
                $('#editmethod').val('PUT');
                $('#formLocationDelete').attr('action', action);
            }
        })
    });
    $(document).on('click', '#add', function() {
        var html = "";
        let id = $(this).data('id');
        let action = $(this).data('action');
        console.log(action);
        $('#ok').text('Ok');
        $('#formLocationAdd').attr('action', action);
    });
</script>
@endsection