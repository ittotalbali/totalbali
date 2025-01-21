@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Mountain Villa - {{ $villa->name }}
            @else
                Add Mountain Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.villa.update_mountain', $villa->id) : route('admin.villa.store_mountain', $villa->id) }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        @if (@$edit_mode)
            @method('PUT')
        @endif
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Montain View</label>
                            <textarea name="mountain_view" id="mountain_view" class="form-control @error('mountain_view') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->mountain_view : old('mountain_view') }}</textarea>
                            @error('mountain_view')
                                <label id="mountain_view-error" class="text-danger pl-3" for="mountain_view">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>View Of Recifield</label>
                            <textarea name="view_of_ricefield" id="view_of_ricefield" class="form-control @error('view_of_ricefield') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->view_of_ricefield : old('view_of_ricefield') }}</textarea>
                            @error('view_of_ricefield')
                                <label id="view_of_ricefield-error" class="text-danger pl-3" for="view_of_ricefield">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Rover Closeby</label>
                            <textarea name="rover_closeby" id="rover_closeby" class="form-control @error('rover_closeby') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->rover_closeby : old('rover_closeby') }}</textarea>
                            @error('rover_closeby')
                                <label id="rover_closeby-error" class="text-danger pl-3" for="rover_closeby">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Waterfall Closeby</label>
                            <textarea name="waterfall_closeby" id="waterfall_closeby" class="form-control @error('waterfall_closeby') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->waterfall_closeby : old('waterfall_closeby') }}</textarea>
                            @error('waterfall_closeby')
                                <label id="waterfall_closeby-error" class="text-danger pl-3" for="waterfall_closeby">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Activities</label>
                            <textarea name="activities" id="activities" class="form-control @error('activities') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->activities : old('activities') }}</textarea>
                            @error('activities')
                                <label id="activities-error" class="text-danger pl-3" for="activities">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Track Information</label>
                            <textarea name="track_information" id="track_information" class="form-control @error('track_information') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->track_information : old('track_information') }}</textarea>
                            @error('track_information')
                                <label id="track_information-error" class="text-danger pl-3" for="track_information">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Birdwatching</label>
                            <textarea name="birdwatching" id="birdwatching" class="form-control @error('birdwatching') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->birdwatching : old('birdwatching') }}</textarea>
                            @error('birdwatching')
                                <label id="birdwatching-error" class="text-danger pl-3" for="birdwatching">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Guide</label>
                            <textarea name="guide" id="guide" class="form-control @error('guide') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->mountain->guide : old('guide') }}</textarea>
                            @error('guide')
                                <label id="guide-error" class="text-danger pl-3" for="guide">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Other</label>
                            <textarea name="other" id="editor" class="form-control @error('other') is-invalid @enderror"" cols="30"
                                rows="4">{{ @$edit_mode ? $villa->mountain->other : old('other') }}</textarea>
                            @error('other')
                                <label id="other-error" class="text-danger pl-3" for="other">{{ $message }}</label>
                            @enderror
                        </div>

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
