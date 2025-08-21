@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Lokasi
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.location.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        <form
            action="{{ @$edit_mode ? route('admin.location.update', ['location' => $location->id]) : route('admin.location.store') }}"
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
                                <label>Countries</label>
                                <select name="country" id="negara"
                                    class="form-control @error('area_id') is-invalid @enderror">
                                    <option value=" "> -- Country -- </option>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <select name="area" id="area"
                                    class="form-control @error('area_id') is-invalid @enderror">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <select name="location" id="lokasi"
                                    class="form-control @error('area_id') is-invalid @enderror">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Location</label>
                                <select name="sub_location" id="subLokasi"
                                    class="form-control @error('area_id') is-invalid @enderror">
                                </select>
                            </div>
                            <a href="{{ route('admin.location.index') }}" class="btn btn-secondary submit">Batal</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        //Lokasi: public/wilayah.js
        $('#negara').change(function() {
            var id_country = $(this).val();
            console.log(id_country);
            if (id_country) {
                $.ajax({
                    type: "GET",
                    url: "./getArea?id_country=" + id_country,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#area").empty();
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            $("#area").append('<option>---Pilih Area---</option>');
                            $.each(res, function(name, id) {
                                $("#area").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                        } else {
                            $("#area").empty();
                            $("#lokasi").empty();
                        }
                    }
                });
            } else {
                $("#area").empty();
                $("#lokasi").empty();
                $("#subLokasi").empty();
            }
        });

        $('#area').change(function() {
            var id_area = $(this).val();
            if (id_area) {
                $.ajax({
                    type: "GET",
                    url: "./getLocation?id_area=" + id_area,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            $("#lokasi").append('<option>---Pilih Lokasi---</option>');
                            $.each(res, function(name, id) {
                                $("#lokasi").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                        } else {
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                        }
                    }
                });
            } else {
                $("#lokasi").empty();
                $("#subLokasi").empty();
            }
        });

        $('#lokasi').change(function() {
            var id_location = $(this).val();
            if (id_location) {
                $.ajax({
                    type: "GET",
                    url: "./getSubLocation?id_location=" + id_location,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#subLokasi").empty();
                            $("#subLokasi").append('<option>---Pilih Sub Lokasi---</option>');
                            $.each(res, function(name, id) {
                                $("#subLokasi").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                        } else {
                            $("#subLokasi").empty();
                        }
                    }
                });
            } else {
                $("#subLokasi").empty();
            }
        });
    </script>
@endsection
