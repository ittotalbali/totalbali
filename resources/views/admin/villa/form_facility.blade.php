@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h4">
                @if (@$edit_mode)
                    Edit Facility - {{ $villa->name }}
                @else
                    Add Facility - {{ $villa->name }}
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.facility_villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form
            action="{{ @$edit_mode ? route('admin.villa.update_facility', $villa->id) : route('admin.villa.store_facility', $villa->id) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @if (@$edit_mode)
                @method('PUT')
            @endif
            <div class="row my-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="table-responsive p-4">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (@$edit_mode)
                                        @foreach ($facility as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="facility_id[]" value="{{ $item->id }}"
                                                        @foreach ($checked as $i)
                                                            {{ $i->facility_id == $item->id ? 'checked' : '' }} 
                                                        @endforeach>
                                                    &nbsp;&nbsp;{{ $item->name }}
                                                </td>
                                                <td><img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                        class="img-fluid" width="100px"></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($facility as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="facility_id[]" value="{{ $item->id }}">
                                                    &nbsp;&nbsp;{{ $item->name }}
                                                </td>
                                                <td><img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                        class="img-fluid" width="100px"></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @error('facility_id')
                                <label id="facility_id-error" class="text-danger pl-3"
                                    for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label>Villa</label>
                                <select name="villa_id" class="form-control @error('villa_id') is-invalid @enderror">
                                    <option value=" "> -- Villas -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($villas as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $facil->villa_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($villas as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label>Facility</label>
                                <select name="facility_id" class="form-control @error('facility_id') is-invalid @enderror">
                                    <option value=" "> -- Facility -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($facilities as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $facil->facility_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($facilities as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <a href="{{ route('admin.villa.edit', ['villa' => $villa->id]) }}" class="btn btn-secondary submit">Batal</a>
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
