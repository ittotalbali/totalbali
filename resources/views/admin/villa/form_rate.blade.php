@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h4">
                @if (@$edit_mode)
                    Edit Rates - {{ $rate->name }} | Villa {{ $villa->name }}
                @else
                    Add Rates | Villa {{ $villa->name }}
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.villa.edit', ['villa' => $villa->id]) }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form
            action="{{ @$edit_mode ? route('admin.villa.update_rate', $rate->id) : route('admin.villa.store_rate', $villa->id) }}"
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
                                    value="{{ @$edit_mode ? $rate->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control  @error('price') is-invalid @enderror"
                                    placeholder="Insert your price" name="price"
                                    value="{{ @$edit_mode ? $rate->price : old('price') }}">
                                @error('price')
                                    <label id="price-error" class="text-danger pl-3" for="price">{{ $message }}</label>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>VIlla</label>
                                <select name="villa_id" class="form-control @error('villa_id') is-invalid @enderror">
                                    <option value=" "> -- Villa -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($villa as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $rate->villa_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($villa as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    @if (@$edit_mode)
                                        <option value="low"{{ $rate->type == 'low' ? 'selected' : '' }}>Low
                                        <option value="base"{{ $rate->type == 'base' ? 'selected' : '' }}>Base
                                        <option value="high"{{ $rate->type == 'high' ? 'selected' : '' }}>High
                                        <option value="peak"{{ $rate->type == 'peak' ? 'selected' : '' }}>Peak
                                        @else
                                        <option value="low">Low
                                        <option value="base">Base
                                        <option value="high">High
                                        <option value="peak">Peak
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control  @error('start_date') is-invalid @enderror"
                                    placeholder="Insert your start date" name="start_date"
                                    value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->start_date)) : old('start_date') }}">
                                @error('start_date')
                                    <label id="start_date-error" class="text-danger pl-3"
                                        for="start_date">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control  @error('end_date') is-invalid @enderror"
                                    placeholder="Insert your end date" name="end_date"
                                    value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->end_date)) : old('end_date') }}">
                                @error('end_date')
                                    <label id="end_date-error" class="text-danger pl-3"
                                        for="end_date">{{ $message }}</label>
                                @enderror
                            </div>
                            <a href="{{ route('admin.villa.edit', ['villa' => $villa->id]) }}"
                                class="btn btn-secondary submit">Batal</a>
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
    {{-- <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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
    </script> --}}
@endsection
