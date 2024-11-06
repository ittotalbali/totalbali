@extends('admin.layouts.master')
@section('page_content')
    <div class="container">
        <div class="card">
            <form action="{{ route('admin.villa.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form">
                    <div class="left-side">
                        <div class="left-heading">
                            <h3>Add Villa</h3>
                        </div>
                        <div class="steps-content">
                            <h3>Step <span class="step-number">1</span></h3>
                            {{-- <p class="step-number-content active">Enter your personal information to get closer to companies.</p>
                            <p class="step-number-content d-none">Get to know better by adding your diploma,certificate and education life.</p>
                            <p class="step-number-content d-none">Help companies get to know you better by telling then about your past experiences.</p>
                            <p class="step-number-content d-none">Add your profile piccture and let companies find youy fast.</p> --}}
                        </div>
                        <ul class="progress-bar-wizard">
                            <li class="active">Type Accomodation</li>
                            <li>Privacy Type</li>
                            <li>Location</li>
                            <li>Total Bedrooms and Bathrooms</li>
                            <li>Facilities</li>
                            <li>Villa Information</li>
                            <li>Villa Description</li>
                            <li>Galeries</li>
                            <li>Base Rate</li>
                            <li>Security Service</li>
                        </ul>
                    </div>
                    <div class="right-side">
                        <div class="main active">

                            <div class="text">
                                <h2>Which of these best describes your place?</h2>
                                {{-- <p>Which of these best describes your place?</p> --}}
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="house" value="house" required require>
                                            <label class="form-check-label" for="house">
                                                House
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="guesthouse" value="guesthouse">
                                            <label class="form-check-label" for="guesthouse">
                                                Guesthouse
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="apartment" value="apartment">
                                            <label class="form-check-label" for="apartment">
                                                Apartment
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="hotel" value="hotel">
                                            <label class="form-check-label" for="hotel">
                                                Hotel
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="buttons">
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>What type of place will guests have?</h2>
                                @error('privacy_type')
                                    <label id="privacy_type-error" class="error mt-2 text-danger"
                                        for="privacy_type">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privacy_type"
                                                id="entireplace" value="entireplace">
                                            <label class="form-check-label" for="entireplace">
                                                An entire place
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privacy_type"
                                                id="room" value="room">
                                            <label class="form-check-label" for="room">
                                                A Room
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privacy_type"
                                                id="sharedroom" value="sharedroom">
                                            <label class="form-check-label" for="sharedroom">
                                                A shared room
                                            </label>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Where's your place located?</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div id="map"></div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control  @error('cor_lat') is-invalid @enderror"
                                            placeholder="Latitude" name="cor_lat" id="cor_lat"
                                            value="{{ @$edit_mode ? $villa->cor_lat : old('cor_lat') }}" readonly required
                                            require>
                                    </div>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control  @error('cor_long') is-invalid @enderror"
                                            placeholder="Longtitude" name="cor_long" id="cor_long"
                                            value="{{ @$edit_mode ? $villa->cor_long : old('cor_long') }}" readonly
                                            required require>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Countries</label>
                                        <select name="country_id" id="negara"
                                            class="form-select @error('area_id') is-invalid @enderror" required require>
                                            <option value=" "> -- Country -- </option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Area</label>
                                        <select name="area_id" id="area"
                                            class="form-select @error('area_id') is-invalid @enderror">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <select name="location_id" id="lokasi"
                                            class="form-select @error('location_id') is-invalid @enderror">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Location</label>
                                        <select name="sub_location_id" id="subLokasi"
                                            class="form-select @error('sub_location_id') is-invalid @enderror">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="10" require></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Maps</label>
                                        <input type="text" name="link_map" class="form-control" require>
                                    </div>
                                </div>
                            </div>

                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Share some basics about your place</h2>
                                <p>You'll add more details later, like bed types.</p>
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Guest</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="guest" required require>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Bedrooms</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bedroom" required require>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Bed</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bed" required require>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Bathroom</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bathroom" required require>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Tell guests what your place has to offer</h2>
                                <p>You can add more amenities after you publish your listing.</p>
                            </div>
                            <div class="input-text">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="kategori">
                                            @foreach ($faciliti as $item)
                                                <div class="tile">
                                                    <input type="checkbox" name="faciliti[]" value="{{ $item->id }}"
                                                        id="{{ $item->id }}">
                                                    <label class="label-kategori" for="{{ $item->id }}">
                                                        {{-- <i class="fas fa-quidditch"></i> --}}
                                                        <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                            class="fas img-fluid" width="150px">
                                                        <h6>{{ $item->name }}</h6>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Villa Information</h2>
                            </div>
                            <div class="my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Staff</label>
                                            <input type="text" name="staff" class="form-control" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Land size</label>
                                            <input type="text" name="landsize" class="form-control" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Building size</label>
                                            <input type="text" name="buildingsize" class="form-control" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Year Built</label>
                                            <input type="text" name="yearbuilt" class="form-control" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Are pets allowed</label>
                                            <select name="pets" id="pets"
                                                class="form-select @error('pets') is-invalid @enderror" required require>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Internet Information</label>
                                            <input type="text" name="internet" class="form-control" require>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Villa Description</h2>
                            </div>
                            <div class="my-4">
                                <div class="form-group">
                                    <label>Villa Code</label>
                                    <input type="text" name="code" class="form-control" require>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" require>
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short" class="form-control" id="" cols="30" rows="5" require></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long" class="form-control" id="" cols="30" rows="10" require></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Old Link</label>
                                    <input type="text" name="old_link" class="form-control" require>
                                </div>
                                <div class="form-group">
                                    <label>New Link</label>
                                    <input type="text" name="new_link" class="form-control" require>
                                </div>
                                <div class="form-group">
                                    <label>Airbnb Link</label>
                                    <input type="text" name="airbnb_link" class="form-control" require>
                                </div>
                                <div class="form-group">
                                    <label>Booking.com Link</label>
                                    <input type="text" name="bookingcom_link" class="form-control" require>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Galeries</h2>
                            </div>
                            <div class="my-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="all-image">
                                            <div class="row" id="table">
                                                <div class="col-md-3" style="margin-bottom: 10px">
                                                    <input type="file" id="input-file-now" class="use-dropify"
                                                        name="image[]"
                                                        data-default-file="{{ @$edit_mode ? asset('uploads/' . $faciliti->image) : '' }}">
                                                </div>
                                                <div id="image-galeries"></div>
                                            </div>
                                            <div class="row">
                                                <button type="button" name="add_image" onclick="tambah_image()"
                                                    class="btn btn-success btn-block"
                                                    style="margin-top: 10px; margin-bottom:10px;">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Base Rate</h2>
                            </div>
                            <div class="my-4">
                                <div class="form-group">
                                    <input type="number" name="base_rate" class="form-control" require>
                                </div>

                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <div class="text">
                                <h2>Does your place have any of these?</h2>
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Security Camera</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="camera" id="camera"
                                            class="form-select @error('camera') is-invalid @enderror" required require>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Weapons</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="weapon" id="weapon"
                                            class="form-select @error('weapon') is-invalid @enderror" required require>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Dangerous Animal</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="animal" id="animal"
                                            class="form-select @error('animal') is-invalid @enderror" required require>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="submit" class="submit_button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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

        input[type="checkbox"]:checked+label .fas.img-fluid {
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
            height: 300px;
        }

        .mapboxgl-canvas {
            width: 100%;
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');

        * {
            padding: 0;
            margin: 0;
        }

        /* .container{
                    min-height:100vh;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    background-color:#eee;
                } */
        .container .card {
            height: auto;
            width: 100%;
            background-color: #fff;
            position: relative;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
            border-radius: 20px;
        }

        .container .card .form {
            width: 100%;
            height: 100%;

            display: flex;
        }

        .container .card .left-side {
            width: 35%;
            background-color: #304767;
            /* height:100%; */
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            padding: 20px 30px;
            box-sizing: border-box;

        }

        /*left-side-start*/
        .left-heading {
            color: #fff;

        }

        .steps-content {
            margin-top: 30px;
            color: #fff;
        }

        .steps-content p {
            font-size: 12px;
            margin-top: 15px;
        }

        .progress-bar-wizard {
            list-style: none;
            /*color:#fff;*/
            margin-top: 30px;
            font-size: 13px;
            font-weight: 700;
            counter-reset: container 0;
        }

        .progress-bar-wizard li {
            position: relative;
            margin-left: 40px;
            margin-top: 50px;
            counter-increment: container 1;
            color: #4f6581;
        }

        .progress-bar-wizard li::before {
            content: counter(container);
            line-height: 25px;
            text-align: center;
            position: absolute;
            height: 25px;
            width: 25px;
            border: 1px solid #4f6581;
            border-radius: 50%;
            left: -40px;
            top: -5px;
            z-index: 10;
            background-color: #304767;


        }

        .progress-bar-wizard li::after {
            content: '';
            position: absolute;
            height: 90px;
            width: 2px;
            background-color: #4f6581;
            z-index: 1;
            left: -27px;
            top: -70px;
        }

        .progress-bar-wizard li.active::after {
            background-color: #fff;

        }

        .progress-bar-wizard li:first-child:after {
            display: none;
        }

        /*.progress-bar-wizard li:last-child:after{*/
        /*  display:none;  */
        /*}*/
        .progress-bar-wizard li.active::before {
            color: #fff;
            border: 1px solid #fff;
        }

        .progress-bar-wizard li.active {
            color: #fff;
        }

        .d-none {
            display: none;
        }

        /*left-side-end*/
        .container .card .right-side {
            width: 65%;
            background-color: #fff;
            height: 100%;
            border-radius: 20px;
        }

        /*right-side-start*/
        .main {
            display: none;
        }

        .active {
            display: block;
        }

        .main {
            padding: 40px;
        }

        .main small {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2px;
            height: 30px;
            width: 30px;
            background-color: #ccc;
            border-radius: 50%;
            color: yellow;
            font-size: 19px;
        }

        .text {
            margin-top: 20px;
        }

        .congrats {
            text-align: center;
        }

        .text p {
            margin-top: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #cbced4;
        }

        .input-text {
            margin: 30px 0;
            display: flex;
            gap: 20px;
        }

        .input-text .input-div {
            width: 100%;
            position: relative;

        }



        input[type="text"] {
            width: 100%;
            height: 40px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        select {
            width: 100%;
            height: 40px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        .input-text .input-div span {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 14px;
            transition: all 0.5s;
        }

        .input-div input:focus~span,
        .input-div input:valid~span {
            top: -15px;
            left: 6px;
            font-size: 10px;
            font-weight: 600;
        }

        .input-div span {
            top: -15px;
            left: 6px;
            font-size: 10px;
        }

        .buttons button {
            height: 40px;
            width: 100px;
            border: none;
            border-radius: 5px;
            background-color: #0075ff;
            font-size: 12px;
            color: #fff;
            cursor: pointer;
        }

        .button_space {
            display: flex;
            gap: 20px;

        }

        .button_space button:nth-child(1) {
            background-color: #fff;
            color: #000;
            border: 1px solid#000;
        }

        .user_card {
            margin-top: 20px;
            margin-bottom: 40px;
            height: 200px;
            width: 100%;
            border: 1px solid #c7d3d9;
            border-radius: 10px;
            display: flex;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
        }

        .user_card span {
            height: 80px;
            width: 100%;
            background-color: #dfeeff;
        }

        .circle {
            position: absolute;
            top: 40px;
            left: 60px;
        }

        .circle span {
            height: 70px;
            width: 70px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        .circle span img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .social {
            display: flex;
            position: absolute;
            top: 100px;
            right: 10px;
        }

        .social span {
            height: 30px;
            width: 30px;
            border-radius: 7px;
            background-color: #fff;
            border: 1px solid #cbd6dc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            color: #cbd6dc;

        }

        .social span i {
            cursor: pointer;
        }

        .heart {
            color: red !important;
        }

        .share {
            color: red !important;
        }

        .user_name {
            position: absolute;
            top: 110px;
            margin: 10px;
            padding: 0 30px;
            display: flex;
            flex-direction: column;
            width: 100%;

        }

        .user_name h3 {
            color: #4c5b68;
        }

        .detail {
            /*margin-top:10px;*/
            display: flex;
            justify-content: space-between;
            margin-right: 50px;
        }

        .detail p {
            font-size: 12px;
            font-weight: 700;

        }

        .detail p a {
            text-decoration: none;
            color: blue;
        }






        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #7ac142;
            }
        }

        .warning {
            border: 1px solid red !important;
        }


        /*right-side-end*/
        @media (max-width:750px) {
            .container {
                height: scroll;


            }

            .container .card {
                max-width: 350px;
                height: auto !important;
                margin: 30px 0;
            }

            .container .card .right-side {
                width: 100%;

            }

            .input-text {
                display: block;
            }

            .input-text .input-div {
                margin-top: 20px;

            }

            .container .card .left-side {

                display: none;
            }
        }
    </style>
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

    <script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(".use-dropify").dropify();
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>
    {{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('admin/plugins/wizard/wizard.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
    <script>
        var next_click = document.querySelectorAll(".next_button");
        var main_form = document.querySelectorAll(".main");
        var step_list = document.querySelectorAll(".progress-bar-wizard li");
        var num = document.querySelector(".step-number");
        let formnumber = 0;

        next_click.forEach(function(next_click_form) {
            next_click_form.addEventListener('click', function() {
                if (!validateform()) {
                    return false
                }
                formnumber++;
                updateform();
                progress_forward();
                contentchange();
            });
        });

        var back_click = document.querySelectorAll(".back_button");
        back_click.forEach(function(back_click_form) {
            back_click_form.addEventListener('click', function() {
                formnumber--;
                updateform();
                progress_backward();
                contentchange();
            });
        });

        var username = document.querySelector("#user_name");
        var shownname = document.querySelector(".shown_name");


        var submit_click = document.querySelectorAll(".submit_button");
        submit_click.forEach(function(submit_click_form) {
            submit_click_form.addEventListener('click', function() {
                shownname.innerHTML = username.value;
                formnumber++;
                updateform();
            });
        });

        var heart = document.querySelector(".fa-heart");
        heart.addEventListener('click', function() {
            heart.classList.toggle('heart');
        });


        var share = document.querySelector(".fa-share-alt");
        share.addEventListener('click', function() {
            share.classList.toggle('share');
        });



        function updateform() {
            main_form.forEach(function(mainform_number) {
                mainform_number.classList.remove('active');
            })
            main_form[formnumber].classList.add('active');
        }

        function progress_forward() {
            // step_list.forEach(list => {

            //     list.classList.remove('active');

            // }); 


            num.innerHTML = formnumber + 1;
            step_list[formnumber].classList.add('active');
        }

        function progress_backward() {
            var form_num = formnumber + 1;
            step_list[form_num].classList.remove('active');
            num.innerHTML = form_num;
        }

        var step_num_content = document.querySelectorAll(".step-number-content");

        function contentchange() {
            step_num_content.forEach(function(content) {
                content.classList.remove('active');
                content.classList.add('d-none');
            });
            step_num_content[formnumber].classList.add('active');
        }


        function validateform() {
            validate = true;
            var validate_inputs = document.querySelectorAll(".main.active input");
            validate_inputs.forEach(function(vaildate_input) {
                vaildate_input.classList.remove('warning');
                if (vaildate_input.hasAttribute('require')) {
                    if (vaildate_input.value.length == 0) {
                        validate = false;
                        vaildate_input.classList.add('warning');
                    }
                }
            });
            return validate;

        }
    </script>

    {{-- IMAGE ARRAY --}}
    <script>
        var i = 0;

        function tambah_image() {
            var html = '';
            html += '<div class="col-md-3" style="margin-bottom: 10px">';
            html += '  <input type="file" class="dropify" data-height="180"  name="image[]">';
            html += '  <button class="btn btn-danger btn-sm btn-block delete-image" type="button">Hapus</button>';
            html += '</div>';
            // html += '<p> baru</p>';
            document.getElementById("image-galeries").insertAdjacentHTML("afterend", html);
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (2M max).'
                }
            });
        };
        $("#all-image").on('click', '.delete-image', function() {
            $(this).closest('div').remove();
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        })
    </script>

    <script>
        //Lokasi: public/wilayah.js
        $('#negara').change(function() {

            console.log('halo');
            var id_country = $(this).val();
            console.log(id_country);
            if (id_country) {
                $.ajax({
                    type: "GET",
                    url: "../sub_location/getArea?id_country=" + id_country,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#area").empty();
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Area not found')
                            } else {
                                $("#area").append('<option>---Insert Area---</option>');
                                $.each(res, function(name, id) {
                                    $("#area").append('<option value="' + id + '">' + name +
                                        '</option>');
                                });
                            }
                        } else {

                            console.log('err');
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
                    url: "../sub_location/getLocation?id_area=" + id_area,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Location not found')
                                // $("#lokasi").empty();
                                // $("#area").empty();
                            } else {
                                $("#lokasi").append('<option>---Insert Location---</option>');
                                $.each(res, function(name, id) {
                                    $("#lokasi").append('<option value="' + id + '">' + name +
                                        '</option>');
                                });
                            }
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
                    url: "../sub_location/getSubLocation?id_location=" + id_location,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Sub Location not found')
                            } else {
                                $("#subLokasi").append('<option>---Insert Sub Location---</option>');
                                $.each(res, function(name, id) {
                                    $("#subLokasi").append('<option value="' + id + '">' +
                                        name +
                                        '</option>');
                                });
                            }
                        } else {
                            $("#subLokasi").empty();
                        }
                    }
                });
            } else {
                $("#subLokasi").empty();
            }
        });

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
            center: [115.1163704915507, -8.334462508224263],
            zoom: 8
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
