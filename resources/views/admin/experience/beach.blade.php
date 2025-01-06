@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Beach Villa - {{ $villa->name }}
            @else
                Add Beach Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.villa.update_beach', $villa->id) : route('admin.villa.store_beach', $villa->id) }}"
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
                            <label>What Beach</label>
                            <textarea name="what_beach" id="what_beach" class="form-control @error('what_beach') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->what_beach : old('what_beach') }}</textarea>
                            @error('what_beach')
                                <label id="what_beach-error" class="text-danger pl-3" for="what_beach">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>How Far Walking</label>
                            <textarea name="how_far_walking" id="how_far_walking" class="form-control @error('how_far_walking') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->how_far_walking : old('how_far_walking') }}</textarea>
                            @error('how_far_walking')
                                <label id="how_far_walking-error" class="text-danger pl-3" for="how_far_walking">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Views Of Ocean</label>
                            <textarea name="views_of_ocean" id="views_of_ocean" class="form-control @error('views_of_ocean') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->views_of_ocean : old('views_of_ocean') }}</textarea>
                            @error('views_of_ocean')
                                <label id="views_of_ocean-error" class="text-danger pl-3" for="views_of_ocean">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Surf Villa</label>
                            <select name="surf_villa" id="surf_villa" class="form-select @error('surf_villa') is-invalid @enderror">
                                <option value="">-- Choose Surf Villa --</option>
                                <option value="yes" {{ @$edit_mode && $villa->beach->surf_villa == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->beach->surf_villa == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('surf_villa')
                                <label id="surf_villa-error" class="text-danger pl-3" for="surf_villa">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Waves Nearby</label>
                            <textarea name="waves_nearby" id="waves_nearby" class="form-control @error('waves_nearby') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->waves_nearby : old('waves_nearby') }}</textarea>
                            @error('waves_nearby')
                                <label id="waves_nearby-error" class="text-danger pl-3" for="waves_nearby">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Extra Information</label>
                            <textarea name="extra_information" id="extra_information" class="form-control @error('extra_information') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->extra_information : old('extra_information') }}</textarea>
                            @error('extra_information')
                                <label id="extra_information-error" class="text-danger pl-3" for="extra_information">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Other Information</label>
                            <textarea name="other_information" id="other_information" class="form-control @error('other_information') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->beach->other_information : old('other_information') }}</textarea>
                            @error('other_information')
                                <label id="other_information-error" class="text-danger pl-3" for="other_information">{{ $message }}</label>
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
