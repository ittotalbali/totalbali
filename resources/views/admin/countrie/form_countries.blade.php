@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                @if (@$edit_mode)
                    Edit Countries - {{ $countries->name }}
                @else
                    Add Countries
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.countries.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form action="{{ @$edit_mode ? route('admin.countries.update', ['countries' => $countries->id]) : route('admin.countries.store') }}"
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
                                    value="{{ @$edit_mode ? $countries->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" id="input-file-now" class="dropify" name="image"
                                    data-default-file="{{ @$edit_mode ? asset('uploads/' . $countries->image) : '' }}">
                                @error('image')
                                    <label id="image-error" class="text-danger pl-3" for="image">{{ $message }}</label>
                                @enderror
                            </div> --}}
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary submit">Batal</a>
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
