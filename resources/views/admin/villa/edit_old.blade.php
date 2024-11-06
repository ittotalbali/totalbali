@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Edit Villa - {{ $villa->name }}
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        @include('admin.layouts.alert')

        <form action="{{ route('admin.villa.update', ['villa' => $villa->id]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="row my-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Insert your name" name="name" value="{{ $villa->name }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <br>
                                <textarea id="editor" name="content" cols="30" rows="5"
                                    class="form-control @error('content') is-invalid @enderror" placeholder="Insert your content" required>{{ $villa->content }}</textarea>
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
                                            value="{{ $villa->cor_lat }}" readonly>
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
                                            value="{{ $villa->cor_long }}" readonly>
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
                                    placeholder="Insert your address">{{ $villa->address }}</textarea>
                                @error('address')
                                    <label id="address-error" class="text-danger pl-3"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Link Map</label>
                                <textarea name="link_map" class="form-control @error('link_map') is-invalid @enderror" cols="30" rows="4"
                                    placeholder="Insert your link map">{{ $villa->link_map }}</textarea>
                                @error('link_map')
                                    <label id="link_map-error" class="text-danger pl-3"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Countries</label>
                                <select name="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                    <option value=" "> -- Countries -- </option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $villa->country_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Areas</label>
                                <select name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value=" "> -- Areas -- </option>
                                    @foreach ($area as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $villa->area_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Facilities</label>
                                <select multiple="multiple" name="faciliti[]" class="SlectBox-grp-src">
                                    @foreach ($faciliti as $item)
                                        <option value="{{ $item->id }}"
                                            @foreach ($checked as $i) {{ $i->facility_id == $item->id ? 'selected' : '' }} @endforeach>
                                            {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                @php $i=1 @endphp
                                <table style="margin-top: 10px">
                                    @foreach ($checked as $item)
                                        <tr>
                                            <td>{{ $i++ }}. </td>
                                            <td>{{ $item->facilities->name }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="col-md-12" id="product-selected">
                                </div>
                            </div>
                            <input type="text" id="id_villa" value="{{ $villa->id }}" hidden>
                            <a href="{{ route('admin.villa.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- RATES --}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Rates</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('permission-create')
                    <a href="{{ route('admin.villa.create_rate', $villa->id) }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="base" role="tabpanel" aria-labelledby="base-tab">
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="height: 600px;overflow:auto;">
                                            @if ($rate->isEmpty())
                                                <div class="text-center" style="margin-top:250px;">
                                                    <i class="fe fe-calendar text-primary" style="font-size: 40px"></i>
                                                    <h6 class="text-muted mt-4">No Events Found</h6>
                                                </div>
                                            @endif
                                            @foreach ($rate as $item)
                                                <div class="card border shadow-none overflow-hidden br-3 mb-4"
                                                    onclick="changedate('{{ $item->start_date }}')">
                                                    @php
                                                        if ($item->type == 'base') {
                                                            $bg = 'bg-base';
                                                            $fn = 'font-base';
                                                        } elseif ($item->type == 'low') {
                                                            $bg = 'bg-low';
                                                            $fn = 'font-low';
                                                        } elseif ($item->type == 'peak') {
                                                            $bg = 'bg-peak';
                                                            $fn = 'font-peak';
                                                        } else {
                                                            $bg = 'bg-high';
                                                            $fn = 'font-high';
                                                        }
                                                        
                                                    @endphp
                                                    <div
                                                        class="card-status card-status-left {{ $bg }} br-bl-7 br-tl-7">
                                                    </div>
                                                    <div class="card-body d-flex flex-column p-3">
                                                        <h4><a href="##"
                                                                onclick="changedate('{{ $item->start_date }}')">{{ $item->name }}</a>
                                                        </h4>
                                                        <div class="text-muted">
                                                            <b>Start</b> =
                                                            {{ date('d-m-Y', strtotime($item->start_date)) }} |
                                                            <b>End</b> = {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                        </div>
                                                        <div class="text-muted">
                                                            <b>Price</b> = USD
                                                            {{ $item->price }}
                                                        </div>
                                                        <div class="text-muted" style="text-align: right;">
                                                            @can('villa-edit')
                                                                <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-success">Edit
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            @can('villa-delete')
                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                    data-toggle="modal"
                                                                    data-target="#delete{{ $item->id }}">
                                                                    Delete
                                                                </button>
                                                            @endcan
                                                        </div>
                                                        <p class="card-custom-icon {{ $fn }}">
                                                            <b>{{ $item->type }}</b>
                                                        </p>
                                                    </div>
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
                                                                        <h5 class="modal-title" id="exampleModalLabel">
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
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="main-content-body main-content-body-calendar card-body border-left">
                                            <div class="main-calendar" id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END RATES --}}

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

    
    <link rel="stylesheet" href="{{ asset('admin/plugins/wizard/wizard.css') }}">
    <style>
        /* RATES */
        .card-custom-icon {
            position: absolute;
            right: 3px;
            top: 15px;
            color: #000000;
            width: 38px;
            height: 60px;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1rem !important;
        }

        .bg-base {
            background-color: #007bff !important;
            color: rgb(255, 255, 255) !important;
        }

        .font-base {
            color: #007bff !important;
        }

        .bg-low {
            background-color: #17a2b8 !important;
            color: rgb(255, 255, 255) !important;
        }

        .font-low {
            color: #17a2b8 !important;
        }

        .bg-high {
            background-color: #FFA41B !important;
            color: rgb(255, 255, 255) !important;
        }

        .font-high {
            color: #FFA41B !important;
        }

        .bg-peak {
            background-color: #dc3545 !important;
            color: rgb(255, 255, 255) !important;
        }

        .font-peak {
            color: #dc3545 !important;
        }

        .br-bl-7 {
            border-bottom-left-radius: 7px !important;
        }

        .br-tl-7 {
            border-top-left-radius: 7px !important;
        }

        .card-status {
            position: absolute;
            top: -1px;
            left: 0px;
            right: 0px;
            height: 3px;
            border-radius: 7px 7px 0px 0px;
            background: rgba(0, 40, 100, 0.12);
        }

        .card-status-left {
            right: auto;
            bottom: 0px;
            height: auto;
            width: 3px;
            border-radius: 3px 0px 0px 3px;
        }

        * {
            box-sizing: border-box;
        }

        .p-3 {
            padding: 0.75rem !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .d-flex {
            display: flex !important;
        }

        .card-body {
            position: relative;
            flex: 1 1 auto;
            margin: 0px;
            padding: 1.5rem;
        }

        .card-body> :last-child {
            margin-bottom: 0px;
        }

        .text-muted {
            color: rgb(114, 128, 150) !important;
        }

        /* END RATES */
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
    <script src='{{ asset('admin/events.js') }}'></script>
    <script src="{{ asset('admin/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>
    <script src="{{ asset('admin/js/formelementadvnced.js') }}"></script>

    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
     <script type="text/javascript" src="{{ asset('admin/plugins/wizard/wizard.js') }}"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
    <script type="text/javascript">
        /* MPAS */
        const geojson = {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'geometry': {
                    'type': 'Point',
                    'coordinates': [{{ $villa->cor_long }}, {{ $villa->cor_lat }}]
                },
                'properties': {
                    'title': '{{ $villa->name }}',
                    'url': `url('{{ asset('icon/marker.png') }}')`,
                    'description': 'Location Villas'
                }
            }]
        };

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
                document.getElementById("cor_lang").value = coordinates.lng;
            });
        });
        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            const url = feature.properties.url;
            el.className = 'marker';

            el.style.backgroundImage = url;
            // make a marker for each feature and add it to the map
            new mapboxgl.Marker(el)
                .setLngLat(feature.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({
                        offset: 25
                    }) // add popups
                    .setHTML(
                        `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
                    )
                )
                .addTo(map);
        }
        /* END-MAPS */

        CKEDITOR.replace('editor', {
            toolbar: 'MyToolbar',
            width: "100%",
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
        });

        function changedate(date) {
            $('#calendar').fullCalendar('gotoDate', date);
        };
        document.getElementById('input-copies').addEventListener('input', event =>
            event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
        );
    </script>
@endsection
