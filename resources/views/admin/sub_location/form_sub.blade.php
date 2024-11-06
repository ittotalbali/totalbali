@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                @if (@$edit_mode)
                    Edit Location - {{ $location->name }}
                @else
                    Add Location
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.location.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form action="{{ @$edit_mode ? route('admin.location.update', ['location' => $location->id]) : route('admin.location.store') }}"
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
                                    value="{{ @$edit_mode ? $location->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <select name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value=" "> -- Area -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($area as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $location->area_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($area as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <a href="{{ route('admin.location.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main>
@endsection
@section('include-css')
@endsection
@section('include-js')
@endsection
