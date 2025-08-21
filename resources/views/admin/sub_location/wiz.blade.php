@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Sub Location</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('area-create')
                    <button type="button" class="btn btn-primary" id="add" data-toggle="modal"
                        data-action="{{ route('admin.sub_location.store') }}" data-target="#formModalAdd">
                        Tambah
                    </button>
                @endcan
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-1">
                    <form action="" method="post" class="f1">
                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4"
                                    style="width: 25%;"></div>
                            </div>
                            <div class="f1-step active">
                                <div class="f1-step-icon"><i class="fa fa-user" style="margin-left: 13px"></i></div>
                                <p>Villa</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-home" style="margin-left: 12px"></i></div>
                                <p>Alamat</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-map" style="margin-left: 13px"></i></div>
                                <p>Akun</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon"><i class="fa fa-address-book" style="margin-left: 13px"></i></div>
                                <p>Sosial</p>
                            </div>
                        </div>
                        <!-- step 1 -->
                        <section>
                            
                            <div id="map"></div>
                            <h4>Masukkan Detail Villa</h4>
                            <div class="form-group">
                                <label>Villa Name</label>
                                <input type="text" name="name" placeholder="Insert your villa name"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Villa Description</label>
                                <textarea name="content" cols="30" rows="8" class="form-control" placeholder="Insert your description villa">{{ @$edit_mode ? $villa->content : old('content') }}</textarea>
                            </div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                            </div>
                        </section>
                        <!-- step 2 -->
                        <section>
                            <h4>Insert Alamat Lengkap</h4>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Link Maps</label>
                                <input type="text" name="alamat_rumah" placeholder="Alamat Rumah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Countries</label>
                                <textarea name="alamat_kantor" placeholder="Alamat Kantor" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <textarea name="alamat_kantor" placeholder="Alamat Kantor" class="form-control"></textarea>
                            </div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i
                                        class="fa fa-arrow-right"></i></button>
                            </div>
                        </section>
                        <!-- step 3 -->
                        <section>
                            <h4>Masukkan Lokasi Villa</h4>
                            <div id="map"></div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i
                                        class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i>
                                    Submit</button>
                            </div>
                        </section>
                        <!-- step 4 -->
                        <section>
                            <h4>Masukkan Detail Villa</h4>
                            <div class="kategori">
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport6">
                                    <label class="label-kategori" for="sport6">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport5">
                                    <label class="label-kategori" for="sport5">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport4">
                                    <label class="label-kategori" for="sport4">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport3">
                                    <label class="label-kategori" for="sport3">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport2">
                                    <label class="label-kategori" for="sport2">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                                <div class="tile">
                                    <input type="checkbox" name="sports" id="sport1">
                                    <label class="label-kategori" for="sport1">
                                        <i class="fas fa-quidditch"></i>
                                        <h6>Quidditch</h6>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label>Villa Name</label>
                                <input type="text" name="name" placeholder="Insert your villa name"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Villa Description</label>
                                <textarea name="content" cols="30" rows="8" class="form-control"
                                    placeholder="Insert your description villa">{{ @$edit_mode ? $villa->content : old('content') }}</textarea>
                            </div> --}}
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i
                                        class="fa fa-arrow-left"></i>
                                    Sebelumnya</button>
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i>
                                    Submit</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('include-css')
    <style>
        .kategori {
            display: flex !important;
            align-items: center;
            /* justify-content: space-around; */
            flex-wrap: wrap;
            gap: 20px;
        }

        .tile {
            height: 200px;
            width: 170px;
            position: relative;
        }

        input[type="checkbox"] {
            -webkit-appearance: none;
            position: relative;
            height: 100%;
            width: 100%;
            background-color: #ffffff;
            border-radius: 10px;
            cursor: pointer;
            border: 3px solid transparent;
            outline: none;
            box-shadow: 15px 15px 25px rgba(2, 28, 53, 0.05);
        }

        input[type="checkbox"]:after {
            position: absolute;
            font-family: "Font Awesome 5 Free";
            font-weight: 400;
            content: "\f111";
            font-size: 22px;
            top: 10px;
            left: 10px;
            color: #e2e6f3;
        }

        input[type="checkbox"]:hover {
            transform: scale(1.08);
        }

        input[type="checkbox"]:checked {
            border: 3px solid #478bfb;
        }

        input[type="checkbox"]:checked:after {
            font-weight: 900;
            content: "\f058";
            color: #478bfb;
        }

        .label-kategori {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
            height: 80%;
            width: 100%;
            position: absolute;
            bottom: 0;
            cursor: pointer;
        }

        label .fas {
            font-size: 60px;
            color: #2c2c51;
        }

        input[type="checkbox"]:checked+label .fas {
            animation: grow 0.5s;
        }

        @keyframes grow {
            50% {
                font-size: 80px;
            }
        }

        label h6 {
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #7b7b93;
        }
    </style>
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
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/wizard/wizard.css') }}">
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
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('admin/plugins/wizard/wizard.js') }}"></script>


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
