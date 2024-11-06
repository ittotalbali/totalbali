@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                @if (@$edit_mode)
                    Edit Villa - {{ $villa->name }}
                @else
                    Add Villa
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        @include('admin.layouts.alert')

        <form action="{{ @$edit_mode ? route('admin.villa.update', ['villa' => $villa->id]) : route('admin.villa.store') }}"
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
                                    value="{{ @$edit_mode ? $villa->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <br>
                                <textarea id="editor" name="content" cols="30" rows="5"
                                    class="form-control @error('content') is-invalid @enderror" placeholder="Insert your content" required>{{ @$edit_mode ? $villa->content : old('content') }}</textarea>
                                @error('content')
                                    <label id="content-error" class="text-danger pl-3"
                                        for="content">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Maps</label>
                                <div id="map"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Coordinate Latitude</label>
                                        <input type="text" class="form-control  @error('cor_lat') is-invalid @enderror"
                                            placeholder="Latitude" name="cor_lat" id="cor_lat"
                                            value="{{ @$edit_mode ? $villa->cor_lat : old('cor_lat') }}" readonly>
                                        @error('cor_lat')
                                            <label id="cor_lat-error" class="text-danger pl-3"
                                                for="cor_lat">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Coordinate Longtitude</label>
                                        <input type="text" class="form-control  @error('cor_long') is-invalid @enderror"
                                            placeholder="Longtitude" name="cor_long" id="cor_long"
                                            value="{{ @$edit_mode ? $villa->cor_long : old('cor_long') }}" readonly>
                                        @error('cor_long')
                                            <label id="cor_long-error" class="text-danger pl-3"
                                                for="cor_long">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="4"
                                    placeholder="Insert your address">{{ @$edit_mode ? $villa->address : old('address') }}</textarea>
                                @error('address')
                                    <label id="address-error" class="text-danger pl-3"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Link Map</label>
                                <textarea name="link_map" class="form-control @error('link_map') is-invalid @enderror" cols="30" rows="4"
                                    placeholder="Insert your link map">{{ @$edit_mode ? $villa->link_map : old('link_map') }}</textarea>
                                @error('link_map')
                                    <label id="link_map-error" class="text-danger pl-3"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Countries</label>
                                <select name="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                    <option value=" "> -- Countries -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $villa->country_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Areas</label>
                                <select name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value=" "> -- Areas -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($area as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $villa->area_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($area as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Facilities</label>
                                <select multiple="multiple" name="faciliti[]" class="SlectBox-grp-src">
                                    @if (@$edit_mode)
                                        @foreach ($faciliti as $item)
                                            <option value="{{ $item->id }}"
                                                @foreach ($checked as $i) {{ $i->facility_id == $item->id ? 'selected' : '' }} @endforeach>
                                                {{ $item->name }} </option>
                                        @endforeach
                                    @else
                                        @foreach ($faciliti as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                                @php $i=1 @endphp
                                <table style="margin-top: 10px">
                                    @foreach ($checked as $item)
                                    <tr>
                                        <td>{{$i++}}. </td>
                                        <td>{{ $item->facilities->name }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                {{-- {{ $item->facilities->name }} --}}
                                {{-- <p></p> --}}
                                <div class="col-md-12" id="product-selected">
                                </div>
                            </div>
                            <a href="{{ route('admin.villa.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if (@$edit_mode)
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Rates</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @can('permission-create')
                        <a href="{{ route('admin.villa.create_rate', $villa->id) }}">
                            <button class="btn btn-primary">Tambah</button>
                        </a>
                    @endcan
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="base-tab" data-toggle="tab" href="#base" role="tab"
                        aria-controls="base" aria-selected="true">Base</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="low-tab" data-toggle="tab" href="#low" role="tab"
                        aria-controls="low" aria-selected="false">Low</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="high-tab" data-toggle="tab" href="#high" role="tab"
                        aria-controls="high" aria-selected="false">High</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="base" role="tabpanel" aria-labelledby="base-tab">
                    <div class="row my-4">
                        <div class="col-12 ">
                            {{-- @include('admin.layouts.alert') --}}
                            <div class="card">
                                <div class="table-responsive p-4">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                            @foreach ($rate_base as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->name }}</td>


                                                    <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                                    {{-- <td>{{ $item->villa->name }}</td> --}}
                                                    <td>{{ $item->type }}</td>
                                                    <td>
                                                        Start : {{ date('d-m-Y', strtotime($item->start_date)) }}
                                                        <br>
                                                        End : {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                    </td>
                                                    <td>
                                                        @can('permission-edit')
                                                            <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                <button class="btn btn-sm btn-outline-success">Edit</button>
                                                            </a>
                                                        @endcan
                                                        @can('permission-delete')
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                                Delete
                                                            </button>
                                                        @endcan

                                                        <!-- Modal -->
                                                        <form action="{{ route('admin.villa.destroy_rate', $item->id) }}"
                                                            method="POST"class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="delete{{ $item->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                Peringatan
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda ingin menghapus data
                                                                            <b>{{ $item->name }}</b>
                                                                            ?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="low" role="tabpanel" aria-labelledby="low-tab">
                    <div class="row my-4">
                        <div class="col-12 ">
                            {{-- @include('admin.layouts.alert') --}}
                            <div class="card">
                                <div class="table-responsive p-4">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                            @foreach ($rate_low as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->name }}</td>


                                                    <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                                    {{-- <td>{{ $item->villa->name }}</td> --}}
                                                    <td>{{ $item->type }}</td>
                                                    <td>
                                                        Start : {{ date('d-m-Y', strtotime($item->start_date)) }}
                                                        <br>
                                                        End : {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                    </td>
                                                    <td>
                                                        @can('permission-edit')
                                                            <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                <button class="btn btn-sm btn-outline-success">Edit</button>
                                                            </a>
                                                        @endcan
                                                        @can('permission-delete')
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                                Delete
                                                            </button>
                                                        @endcan

                                                        <!-- Modal -->
                                                        <form action="{{ route('admin.villa.destroy_rate', $item->id) }}"
                                                            method="POST"class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="delete{{ $item->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                Peringatan
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda ingin menghapus data
                                                                            <b>{{ $item->name }}</b>
                                                                            ?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="high" role="tabpanel" aria-labelledby="high-tab">
                    <div class="row my-4">
                        <div class="col-12 ">
                            {{-- @include('admin.layouts.alert') --}}
                            <div class="card">
                                <div class="table-responsive p-4">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                            @foreach ($rate_high as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->name }}</td>


                                                    <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                                    {{-- <td>{{ $item->villa->name }}</td> --}}
                                                    <td>{{ $item->type }}</td>
                                                    <td>
                                                        Start : {{ date('d-m-Y', strtotime($item->start_date)) }}
                                                        <br>
                                                        End : {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                    </td>
                                                    <td>
                                                        @can('permission-edit')
                                                            <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                <button class="btn btn-sm btn-outline-success">Edit</button>
                                                            </a>
                                                        @endcan
                                                        @can('permission-delete')
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                                Delete
                                                            </button>
                                                        @endcan

                                                        <!-- Modal -->
                                                        <form action="{{ route('admin.villa.destroy_rate', $item->id) }}"
                                                            method="POST"class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="delete{{ $item->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                Peringatan
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda ingin menghapus data
                                                                            <b>{{ $item->name }}</b>
                                                                            ?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </main>
@endsection
@section('include-css')
    <link href='{{ asset('admin/plugins/fullcalendar/fullcalendar.css') }}' rel='stylesheet' />
    <link href='{{ asset('admin/plugins/fullcalendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
    <!--Mutipleselect css-->
    <link rel="stylesheet" href="{{ asset('admin/plugins/multipleselect/multiple-select.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/sumoselect/sumoselect.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/multi/multi.min.css') }}">
    <style>
        #map {
            position: relative;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 500px;
        }

        .marker {
            background-image: url('{{ asset('icon/marker.png') }}');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .mapboxgl-ctrl-bottom-left {
            display: none;
        }

        .mapboxgl-ctrl-bottom-right {
            display: none;
        }
    </style>
@endsection
@section('include-js')
    <script src="{{ asset('admin/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2.js') }}"></script>
    <script src="{{ asset('admin/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ asset('admin/plugins/multipleselect/multi-select.js') }}"></script>
    <script src='{{ asset('admin/plugins/fullcalendar/moment.min.js') }}'></script>
    <script src="{{ asset('admin/plugins/multi/multi.min.js') }}"></script>
    <script src='{{ asset('admin/plugins/fullcalendar/fullcalendar.min.js') }}'></script>
    <script src='{{ asset('admin/js/events.js') }}'></script>
    <script src="{{ asset('admin/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>
    <script src="{{ asset('admin/js/formelementadvnced.js') }}"></script>

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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function changedate(date) {
            $('#calendar').fullCalendar('gotoDate', date);
        };
        document.getElementById('input-copies').addEventListener('input', event =>
            event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
        );
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
    <script type="text/javascript">



        function getmaps() {
            let keyword = $('#keyword').val();
            let url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" + keyword +
                ".json?access_token=pk.eyJ1IjoiaGF5cmVuIiwiYSI6ImNrNjI4ZWkyYjBhaHUzZG8wNHIydnU2M2QifQ.wGG3GZut3cHYlrt0z8Kw9Q";
            $('#text-keyword').text(keyword);
            console.log(url);
            $.getJSON(url, function(result) {
                $.each(result.features, function(i, features) {
                    let html = "";
                    html += "<button type='button' class='btn-marker' data-long='" + features.center[0] +
                        "' data-lat='" + features.center[1] + "' data-center='" + features.center + "'>" +
                        features.place_name + "</button>"
                    html += "<br>"
                    //  html += "<p>kordinat latitude :"+features.center[0]+"</p>"
                    //  html += "<p>kordinat long :"+features.center[1]+"</p>"
                    $("#text-result").append(html);
                    // $("#text-result").append(features.place_name + "<br> <br>");
                    // $("#text-cordinates").append(features.center + "<br> <br>");
                });
                var geojson = result;
                console.log(result.features[0].center[0]);
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: [result.features[0].center[0], result.features[0].center[1]],
                    zoom: 3
                });

                // add markers to map
                // for (const feature of geojson.features) {
                // create a HTML element for each feature
                const el = document.createElement('div');
                el.className = 'marker';

                // make a marker for each feature and add it to the map
                new mapboxgl.Marker(el)
                    .setLngLat(geojson.features[0].center)
                    .addTo(map);
                // }
            });

        }
        mapboxgl.accessToken = 'pk.eyJ1IjoiaGF5cmVuIiwiYSI6ImNrNjI4ZWkyYjBhaHUzZG8wNHIydnU2M2QifQ.wGG3GZut3cHYlrt0z8Kw9Q';


        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [110.41773693636061, -7.751143995756703],
            zoom: 15
        });
        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                // When active the map will receive updates to the device's location as it changes.
                trackUserLocation: true,
                // Draw an arrow next to the location dot to indicate which direction the device is heading.
                showUserHeading: false
            })
        );
        map.on('style.load', function() {

            map.on('click', function(e) {
                $("div").removeClass("marker");
                var coordinates = e.lngLat;
                console.log(coordinates);
                const el = document.createElement('div');
                el.className = 'marker';
                var marker = new mapboxgl.Marker(el)
                    .setLngLat(coordinates)
                    .addTo(map);
                document.getElementById("cor_lat").value = coordinates.lat;
                document.getElementById("cor_long").value = coordinates.lng;
            });
        });
    </script>
@endsection
