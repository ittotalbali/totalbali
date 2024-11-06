@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Retreats Villa - {{ $villa->name }}
            @else
                Add Retreats Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.villa.update_retreats', $villa->id) : route('admin.villa.store_retreats', $villa->id) }}"
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
                            <label>Workout Deck</label>
                            <input type="text" name="workout_deck" id="workout_deck" class="form-control @error('workout_deck') is-invalid @enderror" value="{{ @$edit_mode ? $villa->retreats->workout_deck : old('workout_deck') }}">
                            @error('workout_deck')
                                <label id="workout_deck-error" class="text-danger pl-3" for="workout_deck">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Exlusive Rental</label>
                            <input type="text" name="exclusive_rental" id="exclusive_rental" class="form-control @error('exclusive_rental') is-invalid @enderror" value="{{ @$edit_mode ? $villa->retreats->exclusive_rental : old('exclusive_rental') }}">
                            @error('exclusive_rental')
                                <label id="exclusive_rental-error" class="text-danger pl-3" for="exclusive_rental">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>House Chef</label>
                            <input type="text" name="house_chef" id="house_chef" class="form-control @error('house_chef') is-invalid @enderror" value="{{ @$edit_mode ? $villa->retreats->house_chef : old('house_chef') }}">
                            @error('house_chef')
                                <label id="house_chef-error" class="text-danger pl-3" for="house_chef">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Views From Workout</label>
                            <input type="text" name="views_from_workout" id="views_from_workout" class="form-control @error('views_from_workout') is-invalid @enderror" value="{{ @$edit_mode ? $villa->retreats->views_from_workout : old('views_from_workout') }}">
                            @error('views_from_workout')
                                <label id="views_from_workout-error" class="text-danger pl-3" for="views_from_workout">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gym</label>
                            <input type="text" name="gym" id="gym" class="form-control @error('gym') is-invalid @enderror" value="{{ @$edit_mode ? $villa->retreats->gym : old('gym') }}">
                            @error('gym')
                                <label id="gym-error" class="text-danger pl-3" for="gym">{{ $message }}</label>
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
