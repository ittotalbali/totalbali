@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Rates</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('permission-create')
                    <a href="{{ route('admin.rate.create') }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div>

        <div class="row my-4">
            <div class="col-12 ">
                @include('admin.layouts.alert')
                <div class="card">
                    <div class="table-responsive p-4">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Villa</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($rate as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->villa->name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>
                                            Start : {{ date('d-m-Y', strtotime($item->start_date)) }}
                                            <br>
                                            End : {{ date('d-m-Y', strtotime($item->end_date)) }}
                                        </td>
                                        <td>
                                            @can('permission-edit')
                                                <a href="{{ route('admin.rate.edit', ['rate' => $item->id]) }}">
                                                    <button class="btn btn-sm btn-outline-success">Edit</button>
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                    data-target="#delete{{ $item->id }}">
                                                    Delete
                                                </button>
                                            @endcan

                                            <!-- Modal -->
                                            <form action="{{ route('admin.rate.destroy', ['rate' => $item->id]) }}"
                                                method="POST"class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
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

    </main>
@endsection
@section('include-js')
@endsection
