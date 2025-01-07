@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Family Villa - {{ $villa->name }}
            @else
                Add Family Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.villa.update_family', $villa->id) : route('admin.villa.store_family', $villa->id) }}"
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
                            <label>Pool Fence</label>
                            <textarea name="pool_fence" id="pool_fence" class="form-control @error('pool_fence') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->family->pool_fence : old('pool_fence') }}</textarea>
                            @error('pool_fence')
                                <label id="pool_fence-error" class="text-danger pl-3" for="pool_fence">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Baby Cot</label>
                            <textarea name="baby_cot" id="baby_cot" class="form-control @error('baby_cot') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->family->baby_cot : old('baby_cot') }}</textarea>
                            @error('baby_cot')
                                <label id="baby_cot-error" class="text-danger pl-3" for="baby_cot">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Infant Cot</label>
                            <textarea name="infant_cot" id="infant_cot" class="form-control @error('infant_cot') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->family->infant_cot : old('infant_cot') }}</textarea>
                            @error('infant_cot')
                                <label id="infant_cot-error" class="text-danger pl-3" for="infant_cot">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Baby High Chair</label>
                            <textarea name="baby_high_chair" id="baby_high_chair" class="form-control @error('baby_high_chair') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->family->baby_high_chair : old('baby_high_chair') }}</textarea>
                            @error('baby_high_chair')
                                <label id="baby_high_chair-error" class="text-danger pl-3" for="baby_high_chair">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kids Toys</label>
                            <textarea name="kids_toys" id="kids_toys" class="form-control @error('kids_toys') is-invalid @enderror" cols="30" rows="4">{{ @$edit_mode ? $villa->family->kids_toys : old('kids_toys') }}</textarea>
                            @error('kids_toys')
                                <label id="kids_toys-error" class="text-danger pl-3" for="kids_toys">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Chef</label>
                            <select name="chef" id="chef" class="form-select @error('chef') is-invalid @enderror">
                                <option value="">-- Choose Chef --</option>
                                <option value="yes" {{ @$edit_mode && $villa->family->chef == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ @$edit_mode && $villa->family->chef == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('chef')
                                <label id="chef-error" class="text-danger pl-3" for="chef">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Costs For Chef</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="costs_for_chef_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->family->costs_for_chef_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="number" name="costs_for_chef" id="costs_for_chef" class="form-control @error('costs_for_chef') is-invalid @enderror" value="{{ @$edit_mode ? $villa->family->costs_for_chef : old('costs_for_chef') }}">
                                    @error('costs_for_chef')
                                        <label id="costs_for_chef-error" class="text-danger pl-3" for="costs_for_chef">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nanny Cost</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="nanny_cost_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->family->nanny_cost_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="text" name="nanny_cost" id="nanny_cost" class="form-control @error('nanny_cost') is-invalid @enderror" value="{{ @$edit_mode ? $villa->family->nanny_cost : old('nanny_cost') }}">
                                    @error('nanny_cost')
                                        <label id="nanny_cost-error" class="text-danger pl-3" for="nanny_cost">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Included / Cost per day</label>
                            <div class="row">
                                <div class="col-2">
                                    <select name="included_currency" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->code }}"
                                            {{ @$edit_mode && $villa->family->included_currency == $currency->code ? 'selected' : '' }}>
                                                {{ $currency->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="text" name="included" id="included" class="form-control @error('included') is-invalid @enderror" value="{{ @$edit_mode ? $villa->family->included : old('included') }}">
                                    @error('included')
                                        <label id="included-error" class="text-danger pl-3" for="included">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" id="input-file-now" 
                                   class="use-dropify form-control @error('photos') is-invalid @enderror" 
                                   name="photos"
                                   @if (@$edit_mode && $villa->family->photos)
                                   data-default-file="{{ asset('uploads/' . $villa->family->photos) }}"
                                   @endif>
                            @error('photos')
                                <label id="photos-error" class="text-danger pl-3" for="photos">{{ $message }}</label>
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
