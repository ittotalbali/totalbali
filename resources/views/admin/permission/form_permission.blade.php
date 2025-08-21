@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Permission - {{ $permission->name }}
            @else
                Add Permission
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.permission.index') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form
        action="{{ @$edit_mode ? route('admin.permission.update', ['permission' => $permission->id]) : route('admin.permission.store') }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        @if (@$edit_mode)
            @method('PUT')
        @endif
        <div class="row my-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        @if (@$edit_mode)
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Insert your name" name="name"
                                    value="{{ @$edit_mode ? $permission->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                        @else
                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="name[0]" placeholder="Enter permission name"
                                            class="form-control" />
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add-btn"
                                            class="btn btn-success btn-sm">Add
                                            More</button>
                                    </td>
                                </tr>
                            </table>
                        @endif


                        <a href="{{ route('admin.permission.index') }}" class="btn btn-secondary submit">Batal</a>
                        <button type="submit" class="btn btn-primary submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            console.log('addd');
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="name[' + i +
                ']" placeholder="Enter permission name" class="form-control" /></td><td><button type="button" class="btn btn-danger btn-sm remove-tr">Remove</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
