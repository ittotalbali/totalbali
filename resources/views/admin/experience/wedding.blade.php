@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Wedding Villa - {{ $villa->name }}
            @else
                Add Wedding Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.villa.update_wedding', $villa->id) : route('admin.villa.store_wedding', $villa->id) }}"
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
                            <label>Standing Guest</label>
                            <input type="number" name="standing_guests" id="standing_guests" class="form-control @error('standing_guests') is-invalid @enderror" value="{{ @$edit_mode ? $villa->wedding->standing_guests : old('standing_guests') }}">
                            @error('standing_guests')
                                <label id="standing_guests-error" class="text-danger pl-3" for="standing_guests">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Seated Guest</label>
                            <input type="number" name="seated_guests" id="seated_guests" class="form-control @error('seated_guests') is-invalid @enderror" value="{{ @$edit_mode ? $villa->wedding->seated_guests : old('seated_guests') }}">
                            @error('seated_guests')
                                <label id="seated_guests-error" class="text-danger pl-3" for="seated_guests">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Additional Function Fee</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="additional_function_fee_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->wedding->additional_function_fee_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="number" name="additional_function_fee" id="additional_function_fee" class="form-control @error('additional_function_fee') is-invalid @enderror" value="{{ @$edit_mode ? $villa->wedding->additional_function_fee : old('additional_function_fee') }}">
                                    @error('additional_function_fee')
                                        <label id="additional_function_fee-error" class="text-danger pl-3" for="additional_function_fee">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Banjar Fee</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="banjar_fee_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->wedding->banjar_fee_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="number" name="banjar_fee" id="banjar_fee" class="form-control @error('banjar_fee') is-invalid @enderror" value="{{ @$edit_mode ? $villa->wedding->banjar_fee : old('banjar_fee') }}">
                                    @error('banjar_fee')
                                        <label id="banjar_fee-error" class="text-danger pl-3" for="banjar_fee">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Security Deposit</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="security_deposit_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->wedding->security_deposit_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="number" name="security_deposit" id="security_deposit" class="form-control @error('security_deposit') is-invalid @enderror" value="{{ @$edit_mode ? $villa->wedding->security_deposit : old('security_deposit') }}">
                                    @error('security_deposit')
                                        <label id="security_deposit-error" class="text-danger pl-3" for="security_deposit">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Music Curfew</label>
                            <textarea name="music_curfew" id="music_curfew" class="form-control @error('music_curfew') is-invalid @enderror"" cols="30" rows="4">{{ @$edit_mode ? $villa->wedding->music_curfew : old('music_curfew') }}</textarea>
                            @error('music_curfew')
                                <label id="music_curfew-error" class="text-danger pl-3" for="music_curfew">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Other Information</label>
                            <textarea name="other_informasion" id="other_informasion" class="form-control @error('other_informasion') is-invalid @enderror"" cols="30" rows="4">{{ @$edit_mode ? $villa->wedding->other_informasion : old('other_informasion') }}</textarea>
                            @error('other_informasion')
                                <label id="other_informasion-error" class="text-danger pl-3" for="other_informasion">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Wedding Packages</label>
                            <select name="wedding_packages" class="form-select @error('wedding_packages') is-invalid @enderror">
                                <option value="">-- Choose Wedding Packages --</option>
                                <option value="yes" {{ @$edit_mode && $villa->wedding->wedding_packages == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->wedding->wedding_packages == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('wedding_packages')
                                <label id="wedding_packages-error" class="text-danger pl-3" for="wedding_packages">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Wedding Packgaes Information</label>
                            <textarea name="wedding_packages_information" id="editor" class="form-control @error('wedding_packages_information') is-invalid @enderror"" cols="30"
                                rows="4">{{ @$edit_mode ? $villa->wedding->wedding_packages_information : old('wedding_packages_information') }}</textarea>
                            @error('wedding_packages_information')
                                <label id="wedding_packages_information-error" class="text-danger pl-3" for="wedding_packages_information">{{ $message }}</label>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <label>Ocean Views</label>
                            <select name="ocean_views" class="form-select @error('ocean_views') is-invalid @enderror">
                                <option value="">-- Choose Ocean Views --</option>
                                <option value="yes" {{ @$edit_mode && $villa->wedding->ocean_views == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->wedding->ocean_views == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('ocean_views')
                                <label id="ocean_views-error" class="text-danger pl-3" for="ocean_views">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Garden Weddings</label>
                            <select name="garden_weddings" class="form-select @error('garden_weddings') is-invalid @enderror">
                                <option value="">-- Choose Garden Weddings --</option>
                                <option value="yes" {{ @$edit_mode && $villa->wedding->garden_weddings == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->wedding->garden_weddings == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('garden_weddings')
                                <label id="garden_weddings-error" class="text-danger pl-3" for="garden_weddings">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Beachfront</label>
                            <select name="beachfront" class="form-select @error('beachfront') is-invalid @enderror">
                                <option value="">-- Choose Beachfront --</option>
                                <option value="yes" {{ @$edit_mode && $villa->wedding->beachfront == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->wedding->beachfront == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('beachfront')
                                <label id="beachfront-error" class="text-danger pl-3" for="beachfront">{{ $message }}</label>
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
