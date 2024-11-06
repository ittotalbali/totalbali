<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('icon/logo-pertamina-siaga.png') }}" />
    <link rel="canonical" href="https://rafi.sevenpion.co.id" />
    <title>Total Bali</title>
    
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <style>
      body{
          margin: 0;
          background-color: #097fc2;
          font-family: Futura PT Demi;
      }
      .karyawati{
          position: fixed;
          bottom: 0px;
          right : 10px;
          height: 20vh;
      }
      .logo-pertamina-white{
          position: fixed;
          top:0px;
          right:0px;
          z-index: 1031;
      }
      .title{
          background-image: linear-gradient(to right, white , #097fc2);
          font-size: 20px;
          padding: 10px;
          margin-top:50px;
          font-family: Futura PT Demi;
      }
      .btn-back{
          position: fixed;
          top:0px;
          left:0px;
          background-color: white; /* Green */
          border: none;
          color: #097fc2;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          border-radius: 20%;
      }
      button {
          position: relative;
          display: inline-block;
          cursor: pointer;
          outline: none;
          border: 0;
          vertical-align: middle;
          text-decoration: none;
          background: transparent;
          padding: 0;
          font-size: inherit;
          font-family: inherit;
      }
    
      button.learn-more {
          width: 12rem;
          height: auto;
          position: fixed;
          top:0px;
          left:0px;
      }
    
      button.learn-more .circle {
          transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
          position: relative;
          display: block;
          margin: 0;
          width: 3rem;
          height: 3rem;
          background: white;
          border-radius: 0 0 7.625rem;
      }
    
      button.learn-more .circle .icon {
          transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
          position: absolute;
          top: 0;
          bottom: 0;
          margin: auto;
          background: #097fc2;
      }
    
      button.learn-more .circle .icon.arrow {
          transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
          left: 0.625rem;
          width: 1.125rem;
          height: 0.125rem;
          background: none;
      }
    
      button.learn-more .circle .icon.arrow::before {
          position: absolute;
          content: "";
          top: -0.29rem;
          /* right: 0.0625rem; */
          width: 0.625rem;
          height: 0.625rem;
          border-left: 0.125rem solid #097fc2;
          border-bottom: 0.125rem solid #097fc2;
          transform: rotate(45deg);
      }
    
      button.learn-more .button-text {
          transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          padding: 0.75rem 0;
          margin: 0 0 0 1.85rem;
          color: white;
          font-weight: 700;
          line-height: 1.6;
          text-align: center;
          text-transform: uppercase;
          font-family: Futura PT Demi;
      }
    
      button:hover .circle {
          width: 100%;
      }
    
      button:hover .circle .icon.arrow {
      /* background: #097fc2; */
          transform: translate(1rem, 0);
      }
    
      button:hover .button-text {
          color: #097fc2;
      }
      .nav-font{
        font-family: Futura PT Demi;
        /* font-weight: 600; */
        color: white;
      }
      .navbar-white .navbar-toggler {
        color: rgb(255, 255, 255);  
        border-color: rgb(255, 255, 255);
      }
      .navbar-white .navbar-toggler-icon {
          background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      }
       .navbar-nav .nav-link {
          color: white;
      }
      .footer{
            position: fixed;
            bottom:0px;
            z-index: 99;
            width: 100%;
        }
      a:hover, .nav-font:hover{
        color:red;
        font-weight: 600;
      }
    </style>
        <link rel="stylesheet" href="{{ asset('assets/css/maps.css') }}" >
    
</head>
<body>
  
<div id="modal-container" >
  <div class="modal-background">
    <div class="modal">
      <h5 class="modal-title" id="mod-title">Modal title</h5>
      <hr>
      <div class="row">
        <div class="col-2 my-2">
          <img src="{{ asset('icon/motorist.png') }}" alt="" width="50">
        </div>
        <div class="col-10">
          <h5>Motorist</h5>
        </div>
        <div class="col-2 my-2">
          <img src="{{ asset('icon/kantong.png') }}" alt="" width="50">
        </div>
        <div class="col-10">
          <h5>Kantong</h5>
        </div>
        <div class="col-2 my-2">
          <img src="{{ asset('icon/test-kesehatan.png') }}" alt="" width="50">
        </div>
        <div class="col-10">
          <h5>Test Kesehatan</h5>
        </div>
      </div>
      <hr>
      <h6 id="mod-address">Jalan Sesama</h6>
      <p id="mod-information">Informasi Pendukung</p>
    </div>
  </div>
</div>
<div class="content">
  <div id="map" ></div>
  
  
</div>

    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> --}}
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

<script type="text/javascript">
mapboxgl.accessToken = 'pk.eyJ1IjoiaGF5cmVuIiwiYSI6ImNrNjI4ZWkyYjBhaHUzZG8wNHIydnU2M2QifQ.wGG3GZut3cHYlrt0z8Kw9Q';
const map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [117.73004049741473, -0.619455297069706],
  zoom: 4.4
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
$(document).ready(function (){
  var urigeo = "{{ route('geojson') }}";
  $.getJSON(urigeo, function(response) {
    // console.log(response);
    $.each(response, function(i, feature){
    console.log(feature); // Log the feature object for debugging
    const el = document.createElement('div');
    var url = `url('{{ asset("icon/marker.png") }}')`;
    let coordinates = '['+feature.lng+','+feature.lat+']';
    el.className = 'marker';
    el.style.backgroundImage = url;
    new mapboxgl.Marker(el)
        .setLngLat([feature.cor_long, feature.cor_lat])
        .setPopup(
            new mapboxgl.Popup({ offset: 25 })
            .setHTML(
                '<br>' +
                '<h6>' + feature.name + '</h6>' +
                '<p>' + feature.code + '</p>' +
                '<button class="btn btn-sm btn-outline-success btn-block" onclick="modfun(' + feature.id + ')">Detail</button>'
            )
        )
        .addTo(map);
});

  });
 
});
function modfun(e) {
    // alert('Produk tidak ditemukan');
    let id = e;
    let data = {
        'id': id,
        '_token': '{{csrf_token()}}',
    };
    console.log(data);
    $.ajax({
        url: "{{ route('getpoint') }}",
        method: 'post',
        data: data,
        success: function(response) {
            if (response != '') {
                let obj = JSON.parse(response);
                // console.log(obj);
                let modal = $('#mod-show-point');
                
                $('#mod-title').text(obj.name);
                $('#mod-address').text(obj.address);
                $('#mod-information').text(obj.information);
                // modal.modal();
                $('#modal-container').removeAttr('class').addClass('five');
                $('body').addClass('modal-active');
            } else {
                alert('Point tidak ditemukan');
            }
        }
    });
  };
  function region(id) {
    var urigeo = "{{ url('regionjson') }}/"+id;
    // console.log(urigeo);
    $('.marker').remove();
    // $('.mapboxgl-canary').remove();
    // $('.mapboxgl-canvas-container').remove();
    // $('.mapboxgl-control-container').remove();
    $.getJSON(urigeo, function(response) {
      // console.log(response);
      map.flyTo({ 
        center: [response.points[0].lng, response.points[0].lat], 
        zoom: 7 
      });
      // const map = new mapboxgl.Map({
      //   container: 'map',
      //   style: 'mapbox://styles/mapbox/streets-v11',
      //   center: [response.points[0].lng, response.points[0].lat],
      //   zoom: 7
      // });
      // map.addControl(
      //     new mapboxgl.GeolocateControl({
      //         positionOptions: {
      //         enableHighAccuracy: true
      //     },
      //     // When active the map will receive updates to the device's location as it changes.
      //     trackUserLocation: true,
      //     // Draw an arrow next to the location dot to indicate which direction the device is heading.
      //     showUserHeading: false
      //     })
      // );
      // console.log(response);
      $.each(response.points, function(i, feature){
        const el = document.createElement('div');
        var url = `url('{{ asset("icon/marker.png") }}')`;
        // if (feature.type == 'spbu') {
        //   var url = `url('{{ asset("icon/spbu.png") }}')`;
        // } else{
        //   var url = `url('{{ asset("icon/pertashop.png") }}')`;
        // }
        // console.log(url);
        let coordinates = '['+feature.lng+','+feature.lat+']';
        el.className = 'marker';
        // console.log(coordinates);
        
        el.style.backgroundImage = url;
        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat([feature.lng, feature.lat])
          .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
              .setHTML(
                '<br>' +
                '<h6>' + feature.title + '</h6>' +
                '<p>' + feature.code + '</p>' +
                '<button class="btn btn-sm btn-outline-success btn-block" onclick="modfun(' + feature.id + ')">Detail</button>'
              )
          )
          .addTo(map);
      });
      window.open("{{ url('region') }}/"+response.regions.slug);
    });
  };
  function getall() {
    var urigeo = "{{ route('geojson') }}";
    console.log(urigeo);
    $('.marker').remove();
    // $('.mapboxgl-canary').remove();
    // $('.mapboxgl-canvas-container').remove();
    // $('.mapboxgl-control-container').remove();
    $.getJSON(urigeo, function(response) {
      map.flyTo({ 
        center: [117.73004049741473, -0.619455297069706], 
        zoom: 4.4
      });
      // const map = new mapboxgl.Map({
      //   container: 'map',
      //   style: 'mapbox://styles/mapbox/streets-v11',
      //   center: [117.73004049741473, -0.619455297069706],
      //   zoom: 4.4
      // });
      // map.addControl(
      //     new mapboxgl.GeolocateControl({
      //         positionOptions: {
      //         enableHighAccuracy: true
      //     },
      //     // When active the map will receive updates to the device's location as it changes.
      //     trackUserLocation: true,
      //     // Draw an arrow next to the location dot to indicate which direction the device is heading.
      //     showUserHeading: false
      //     })
      // );
      // console.log(response);
      $.each(response, function(i, feature){
        const el = document.createElement('div');
        var url = `url('{{ asset("icon/marker.png") }}')`;
        // console.log(url);
        let coordinates = '['+feature.lng+','+feature.lat+']';
        el.className = 'marker';
        // console.log(coordinates);
        
        el.style.backgroundImage = url;
        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat([feature.cor_long, feature.cor_lat])
          .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
              .setHTML(
                '<br>' +
                '<h6>' + feature.title + '</h6>' +
                '<p>' + feature.code + '</p>' +
                '<button class="btn btn-sm btn-outline-success btn-block" onclick="modfun(' + feature.id + ')">Detail</button>'
              )
          )
          .addTo(map);
      });
    });
  };
$('#modal-container').click(function () {
  $(this).addClass('out');
  $('body').removeClass('modal-active');
});
function getmaps(){
    let keyword = $('#keyword').val();
    let url = "https://api.mapbox.com/geocoding/v5/mapbox.places/"+keyword+".json?access_token=pk.eyJ1IjoiaGF5cmVuIiwiYSI6ImNrNjI4ZWkyYjBhaHUzZG8wNHIydnU2M2QifQ.wGG3GZut3cHYlrt0z8Kw9Q";
    $('#text-keyword').text(keyword);
    console.log(url);
    $.getJSON(url, function(result){
      $.each(result.features, function(i, features){
        let html = "";
         html += "<button type='button' class='btn-marker' data-long='"+features.center[0]+"' data-lat='"+features.center[1]+"' data-center='"+features.center+"'>"+features.place_name+"</button>"
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

</script>
</body>
</html>
