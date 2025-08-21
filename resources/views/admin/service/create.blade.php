@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Service - {{ $service->name }}
            @else
                Add Service
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.service.index') }}" class="btn btn-outline-success">
                Kembali
            </a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.service.update') : route('admin.service.store') }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row my-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="service_id" 
                        value="{{ @$edit_mode ? $service->id : null }}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Insert service name" name="name"
                                value="{{ @$edit_mode ? $service->name : old('name') }}">
                            @error('name')
                                <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" id="input-file-now" class="use-dropify" name="image"
                                data-default-file="{{ @$edit_mode ? asset('uploads/' . $service->image) : '' }}">
                            @error('image')
                                <label id="image-error" class="text-danger pl-3" for="image">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <br>
                            <textarea id="editor" name="description" cols="30" rows="5"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Insert your description" required>{{ @$edit_mode ? $service->description : old('description') }}</textarea>
                            @error('description')
                                <label id="description-error" class="text-danger pl-3"
                                    for="description">{{ $message }}</label>
                            @enderror
                        </div>
                        <a href="{{ route('admin.service.index') }}" class="btn btn-secondary submit">Batal</a>
                        <button type="submit" class="btn btn-primary submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('include-css')
    <link rel="stylesheet" href="{{ asset('admin/vendors/dropify/dist/dropify.min.css') }}">
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
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor', {
            toolbar: 'MyToolbar',
            width: "100%",
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
        });

        //]]>
    </script>

    <script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(".use-dropify").dropify();
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>
@endsection
