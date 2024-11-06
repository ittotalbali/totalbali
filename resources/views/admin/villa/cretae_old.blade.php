@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Add Villa
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        @include('admin.layouts.alert')

        <form action="{{ route('admin.villa.store') }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row my-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Insert your name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <br>
                                <textarea id="editor" name="content" cols="30" rows="5"
                                    class="form-control @error('content') is-invalid @enderror" placeholder="Insert your content" required>{{ old('content') }}</textarea>
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
                                            value="{{ old('cor_lat') }}" readonly>
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
                                            value="{{ old('cor_long') }}" readonly>
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
                                    placeholder="Insert your address">{{ old('address') }}</textarea>
                                @error('address')
                                    <label id="address-error" class="text-danger pl-3"
                                        for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Link Map</label>
                                <textarea name="link_map" class="form-control @error('link_map') is-invalid @enderror" cols="30" rows="4"
                                    placeholder="Insert your link map">{{ old('link_map') }}</textarea>
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
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Areas</label>
                                <select name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value=" "> -- Areas -- </option>
                                    @foreach ($area as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Facilities</label>
                                <select multiple="multiple" name="faciliti[]" class="SlectBox-grp-src">
                                    @foreach ($faciliti as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                    @endforeach
                                </select>
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
