@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Role - {{ $role->name }}
            @else
                Add Role
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.role.index') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>
    @include('admin.layouts.alert')

    <form action="{{ @$edit_mode ? route('admin.role.update', ['role' => $role->id]) : route('admin.role.store') }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        @if (@$edit_mode)
            @method('PUT')
        @endif
        <div class="row my-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Insert your name" name="name"
                                value="{{ @$edit_mode ? $role->name : old('name') }}">
                            @error('name')
                                <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Permission</label>
                            <br />
                            @if (@$edit_mode)
                                <div class="row">
                                    @foreach ($permission as $item)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permission[]" class="form-check-input"
                                                        value="{{ $item->id }}"
                                                        {{ in_array($item->id, $rolePermissions) ? 'checked' : '' }}>
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    @foreach ($permission as $item)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input
                                                        class="form-check-input @error('permission') is-invalid @enderror"
                                                        type="checkbox" name="permission[]" value="{{ $item->id }}"
                                                        @if (is_array(old('permission')) && in_array($item->id, old('permission'))) checked @endif>
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @error('permission')
                                <label id="permission-error" class="error mt-2 text-danger"
                                    for="permission">{{ $message }}</label>
                            @enderror
                        </div>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary submit">Batal</a>
                        <button type="submit" class="btn btn-primary submit">Simpan</button>

                    </div>
                </div>
            </div>
    </form>
@endsection
@section('include-js')
@endsection
