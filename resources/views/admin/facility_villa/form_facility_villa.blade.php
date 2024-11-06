@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                @if (@$edit_mode)
                    Edit Facility Villa - {{ $facil->villas->name }}
                @else
                    Add Facility Villa
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.facility_villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form action="{{ @$edit_mode ? route('admin.facility_villa.update', ['facility_villa' => $facil->id]) : route('admin.facility_villa.store') }}"
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
                            </div>
                            <div class="form-group">
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
                            </div>
                            <a href="{{ route('admin.facility_villa.index') }}" class="btn btn-secondary submit">Batal</a>
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
