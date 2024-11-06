@extends('admin.layouts.master')
@section('page_content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Facilities</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('faciliti-create')
                    <a href="{{ route('admin.faciliti.create') }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Facilities</h1>
    </div>

      <!-- Modal DELETE -->
      <div id="formModalDanger"></div>
    <div class="modal fade" id="formModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST"class="d-inline" id="formFacilitiDelete">
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
                        Apakah Anda ingin menghapus data <b id="namaFaciliti"></b>
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
                        <h6 class="card-title">Data Facilities</h6>
                        @can('faciliti-create')
                            <a href="{{ route('admin.faciliti.create') }}">
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
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($faciliti as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                class="img-fluid" width="100px"></td>
                                        <td>
                                            @can('faciliti-edit')
                                                <a href="{{ route('admin.faciliti.edit', $item->id) }}">
                                                    <button class="btn btn-sm btn-outline-success">Edit</button>
                                                </a>
                                            @endcan
                                            @can('faciliti-delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger cek-data"
                                                        data-toggle="modal" data-id="{{ $item->id }}"
                                                        data-action="{{ route('admin.faciliti.destroy', $item->id) }}">
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
@section('include-js')
    <script>
        $(document).on('click', '.cek-data', function() {
            let id = $(this).data('id');
            let action = $(this).data('action');
            console.log(id);
            // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
            $.ajax({
                url: "faciliti/cek_data/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data.faciliti.villas.length);
                    if (data.faciliti.villas.length == 0) {
                        console.log('kosong');
                        // $("#validasi").empty();
                        $("#formModalDelete").modal('show');
                        $("#formModalDanger").empty();
                    } else {
                        $("#formModalDanger").html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<strong>Data Area : ' +
                            '</strong> has derivatives, please delete the data first' +
                            '<ol>' +
                            '<li>Villa</li>' +
                            '</ol>' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>'
                        );
                        // $("#formModalDelete").modal('hide');
                        // $("#validasi").empty();
                        console.log('tidak');
                    }
                    // return ;
                    $('#namaFaciliti').html(data.faciliti.name);
                    $('#editmethod').val('PUT');
                    $('#formFacilitiDelete').attr('action', action);
                }
            })
        });
            // $(document).on('click', '.cek-data', function() {
            //     let id = $(this).data('id');
            //     let action = $(this).data('action');
            //     // $('.SlectBox-grp-src')[0].sumo.unSelectAll();
            //     $.ajax({
            //         url: "faciliti/cek_data/" + id,
            //         type: 'GET',
            //         data: {
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(data) {
            //             console.log(data); // Tambahkan variabel data di sini
            //             if (data.validasi == true) {
            //                 console.log('kosong');
            //                 // $("#validasi").empty();
            //                 $("#formModalDelete").modal('show');
            //                 $("#formModalDanger").empty();
            //             } else {
            //                 $("#formModalDanger").html(
            //                     '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            //                     '<strong>Data Facilities : ' + data.faciliti.name +
            //                     '</strong> has derivatives, please delete the data first' +
            //                     '<ol>' + data.villa +
            //                     '</ol>' +
            //                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            //                     '<span aria-hidden="true">&times;</span>' +
            //                     '</button>' +
            //                     '</div>'
            //                 );
            //                 $("#formModalDelete").modal('hide');
            //                 // $("#validasi").empty();
            //                 console.log('tidak');
            //             }
            //             // return ;
            //             $('#namaFaciliti').html(data.faciliti.name);
            //             $('#editmethod').val('PUT');
            //             $('#formFacilitiDelete').attr('action', action);
            //         }
            //     })
            // });
    </script>
@endsection
