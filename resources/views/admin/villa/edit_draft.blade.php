@extends('admin.layouts.master')
@section('page_content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 position-relative">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Villa - {{ $edit->name }}
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.index') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    @include('admin.layouts.alert')
    <div class="container">
        <div class="card">
            <form action="{{ route('admin.villa.update', ['id' => $edit->id]) }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form">
                    <div class="left-side">
                        <div class="left-heading">
                            {{-- <h3>Add Villa</h3> --}}
                        </div>
                        <div class="steps-content">
                            <h3>Step <span class="step-number">1</span></h3>
                            {{-- <p class="step-number-content active">Enter your personal information to get closer to
                                companies.</p>
                            <p class="step-number-content d-none">Get to know better by adding your diploma,certificate
                                and education life.</p>
                            <p class="step-number-content d-none">Help companies get to know you better by telling then
                                about your past experiences.</p>
                            <p class="step-number-content d-none">Add your profile piccture and let companies find youy
                                fast.</p> --}}
                        </div>
                        <ul class="progress-bar-wizard">
                            <li class="active" onclick="next_jump(0)">Type Accomodation</li>
                            <li onclick="next_jump(1)">Privacy Type</li>
                            <li onclick="next_jump(2)">Location</li>
                            <li onclick="next_jump(3)">Total Bedrooms and Bathrooms</li>
                            <li onclick="next_jump(4)">Services</li>
                            <li onclick="next_jump(5)">Facilities</li>
                            <li onclick="next_jump(6)">Villa Information</li>
                            <li onclick="next_jump(7)">Villa Description</li>
                            <li onclick="next_jump(8)">Galeries</li>
                            <li onclick="next_jump(9)">Base Rate</li>
                            <li onclick="next_jump(10)">Security Service</li>
                            <li onclick="next_jump(11)">Villa Include</li>
                            <li onclick="next_jump(12)">Inclusions</li>
                            <li onclick="next_jump(13)">Staff At Villa</li>
                            <li onclick="next_jump(14)">Cooking System</li>
                            <li onclick="next_jump(15)">Car And Driver</li>
                            <li onclick="next_jump(16)">Album</li>
                            <li onclick="next_jump(17)">Floor Plan</li>
                            <li onclick="next_jump(18)">Pricing</li>
                        </ul>
                    </div>
                    <div class="right-side">
                        <div class="main active">
                            <div class="form-group">
                                <label>Name Villa</label>
                                <input type="text" name="name" id="villa-name" class="form-control"
                                    value="{{ $edit->name }}" onkeyup="gen_villa_code()">
                            </div>
                            <!-- <div class="form-group">
                                <label>Link Ical</label>
                                <input type="text" name="link_ical" id="link-ical" class="form-control"
                                    value="{{ $edit->link_ical }}">
                            </div> -->
                            <div class="text">
                                <h2>Which of these best describes your place?</h2>
                                {{-- <p>Which of these best describes your place?</p> --}}
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="house" value="house" {{ $edit->type_accomodation == 'house' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="house">
                                                House
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="villa" value="villa" {{ $edit->type_accomodation == 'villa' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="villa">
                                                Villa
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="guesthouse" value="guesthouse" {{ $edit->type_accomodation == 'guesthouse' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="guesthouse">
                                                Guesthouse
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="apartment" value="apartment" {{ $edit->type_accomodation == 'apartment' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="apartment">
                                                Apartment
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_accomodation"
                                                id="hotel" value="hotel" {{ $edit->type_accomodation == 'hotel' ? 'checked' : '' }}>
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
                                                id="entireplace" value="entireplace" {{ $edit->privacy_type == 'entireplace' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="entireplace">
                                                An entire place
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privacy_type" id="room"
                                                value="room" {{ $edit->privacy_type == 'room' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="room">
                                                A Room
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privacy_type"
                                                id="sharedroom" value="sharedroom" {{ $edit->privacy_type == 'sharedroom' ? 'checked' : '' }}>
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
                                <button type="submit" class="btn btn-info">Save Draft</button>
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
                                            value="{{ $edit->cor_lat }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control  @error('cor_long') is-invalid @enderror"
                                            placeholder="Longtitude" name="cor_long" id="cor_lang"
                                            value="{{ $edit->cor_long }}">
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Countries</label>
                                        <select name="country_id" id="negara"
                                            class="form-select @error('area_id') is-invalid @enderror">
                                            <option value=" "> -- Country -- </option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}" {{ $edit->country_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Area</label>
                                        <select name="area_id" id="area" onchange="gen_villa_code()"
                                            class="form-select @error('area_id') is-invalid @enderror">
                                            @foreach ($area as $item)
                                                <option value="{{ $item->id }}" {{ $edit->area_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <select name="location_id" id="lokasi" onchange="gen_villa_code()"
                                            class="form-select @error('location_id') is-invalid @enderror">
                                            @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}" {{ $edit->location_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Location</label>
                                        <select name="sub_location_id" id="subLokasi" onchange="gen_villa_code()"
                                            class="form-select @error('sub_location_id') is-invalid @enderror">
                                            @foreach ($sublokasi as $item)
                                                <option value="{{ $item->id }}" {{ $edit->sub_location_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" id="" cols="30"
                                            rows="10">{{ $edit->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Maps</label>
                                        <input type="text" name="link_map" class="form-control"
                                            value="{{ $edit->link_map }}">
                                    </div>
                                </div>
                            </div>

                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
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
                                        <h3>Number of guest</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="guest"
                                            value="{{ $edit->guest }}">
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Total Bedrooms</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bedroom" id="bedroom-qty"
                                            onkeyup="gen_villa_code()" value="{{ $edit->bedroom }}">
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Total Bed</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bed" value="{{ $edit->bed }}">
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Total Bathroom</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="bathroom" id="bathroom-qty"
                                            value="{{ $edit->bathroom }}">
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        <div class="main">
                            <div class="text">
                                <h2>Tell guests what services available on your place</h2>
                                <p>You can add more amenities after you publish your listing.</p>
                            </div>
                            <div class="input-text">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="kategori">
                                            @foreach ($master_service as $key => $item)
                                                <div class="tile">
                                                    <input type="checkbox" name="service[]" value="{{ $item->id }}"
                                                        id="{{ $item->id }}" 
                                                        {{ in_array($item->id, $service_villa) ? 'checked' : '' }}>
                                                    <label class="label-kategori" for="{{ $item->id }}">
                                                        {{-- <i class="fas fa-quidditch"></i> --}}
                                                        <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                            class="fas img-fluid" style="max-height: 100px">
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
                                <button type="submit" class="btn btn-info">Save Draft</button>
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
                                            @foreach ($faciliti as $key => $item)
                                                <div class="tile">
                                                    <input type="checkbox" name="faciliti[]" value="{{ $item->id }}"
                                                        id="{{ $item->id }}" {{ $item->villa != null ? 'checked' : '' }}>
                                                    <label class="label-kategori" for="{{ $item->id }}">
                                                        {{-- <i class="fas fa-quidditch"></i> --}}
                                                        <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                                            class="fas img-fluid" style="max-height: 100px">
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
                                <button type="submit" class="btn btn-info">Save Draft</button>
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
                                            <input type="text" name="staff" class="form-control"
                                                value="{{ $edit->staff }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Land size</label>
                                            <input type="text" name="landsize" class="form-control"
                                                value="{{ $edit->landsize }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Building size</label>
                                            <input type="text" name="buildingsize" class="form-control"
                                                value="{{ $edit->buildingsize }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Year Built</label>
                                            <input type="text" name="yearbuilt" class="form-control"
                                                value="{{ $edit->yearbuilt }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Renovation</label>
                                            <input type="text" name="last_renovation" class="form-control"
                                                value="{{ $edit->last_renovation }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Are pets allowed</label>
                                            <select name="pets" id="pets"
                                                class="form-select @error('pets') is-invalid @enderror">
                                                <option value="yes" {{ $edit->pets == 'yes' ? 'selected' : '' }}> Yes
                                                </option>
                                                <option value="no" {{ $edit->pets == 'no' ? 'selected' : '' }}> No
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Wheelchair friendly</label>
                                            <select name="wheelchair_friendly" id="wheelchair_friendly"
                                                class="form-select @error('wheelchair_friendly') is-invalid @enderror">
                                                <option value="yes" {{ $edit->wheelchair_friendly == 'yes' ? 'selected' : '' }}> Yes</option>
                                                <option value="no" {{ $edit->wheelchair_friendly == 'no' ? 'selected' : '' }}> No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Internet Information</label>
                                            <input type="text" name="internet" class="form-control"
                                                value="{{ $edit->internet }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        <div class="main">
                            <div class="text">
                                <h2>Villa Description</h2>
                            </div>
                            <div class="my-4">
                                <div class="form-group">
                                    <label>Villa Code</label>
                                    <div class="input-group mb-3">
                                        {{-- <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="basic-addon3">https://totalbali.com/</span>
                                        </div> --}}
                                        <input type="text" name="code" class="form-control" id="villa-code"
                                            aria-describedby="basic-addon3" value="{{ $edit->code }}" readonly>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $edit->title }}">
                                </div> --}}
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short" class="form-control" id="" cols="30"
                                        rows="5">{{ $edit->short }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long" class="form-control" id="" cols="30"
                                        rows="10">{{ $edit->long }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Old Link</label>
                                    <input type="text" name="old_link" class="form-control"
                                        value="{{ $edit->old_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="new_link" class="form-control"
                                        value="{{ $edit->new_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Airbnb Link</label>
                                    <input type="text" name="airbnb_link" class="form-control"
                                        value="{{ $edit->airbnb_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Booking.com Link</label>
                                    <input type="text" name="bookingcom_link" class="form-control"
                                        value="{{ $edit->bookingcom_link }}">
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
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
                                                @foreach ($edit->galeries as $item)
                                                    <div class="col-md-3" style="margin-bottom: 10px">
                                                        <input type="file" id="input-file-now" class="use-dropify"
                                                            name="image_edit[{{ $item->id }}]"
                                                            data-default-file="{{ asset('uploads/' . $item->image) }}">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger btn-block delete-galeri"
                                                            data-image="{{ asset('uploads/' . $item->image) }}"
                                                            data-link="{{ route('admin.villa.destroy_galeri', ['id' => $item->id]) }}">
                                                            <i class="fa fa-trash pr-2"></i>Delete
                                                        </button>
                                                    </div>
                                                @endforeach
                                                <div id="image-galeries"></div>
                                            </div>
                                            <div class="row">
                                                <button type="button" name="add_image" onclick="tambah_image()"
                                                    class="btn btn-success btn-block"
                                                    style="margin-top: 10px; margin-bottom:10px;"><i
                                                        class="fa fa-plus-circle pr-2"></i>Add Image</button>
                                                <div class="col-12">
                                                <strong><p style="color:crimson;">Image Format .jpg .jpeg dan .png</p></strong>
                                                <strong><p style="color:crimson;">So that images are more optimal, compress files up to 300kb in size</p></strong>
                                                </div>
                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        <div class="main">
                            <div class="text">
                                <h2>Base Rate</h2>
                            </div>
                            <div class="form-group">
                                <label>Currency</label>
                                <select name="base_rate_currency" id="base_rate_currency"
                                    class="form-select @error('base_rate_currency') is-invalid @enderror">
                                    <option value="">Select Currency</option>
                                    @foreach ($master_currency as $currency)
                                        <option value="{{ $currency->code }}" {{ $edit->base_rate_currency == $currency->code ? 'selected' : '' }}>
                                            {{ $currency->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <div class="form-group">
                                    <input type="number" name="base_rate" class="form-control"
                                        value="{{ $edit->base_rate }}">
                                </div>
                            </div>
                                
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        <div class="main">
                            <div class="text">
                                <h2>Does your place have any of these?</h2>
                            </div>
                            <div class="input-text">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Night Security / Satpam</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="security_night" id="security_night"
                                            class="form-select @error('security_night') is-invalid @enderror">
                                            <option value="">-- Choose Night Security --</option>
                                            <option value="yes" {{ $edit->security_night == 'yes' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="no" {{ $edit->security_night == 'no' ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>Day Security / Satpam</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="security_day" id="security_day"
                                            class="form-select @error('security_day') is-invalid @enderror">
                                            <option value="">-- Choose Day Security --</option>
                                            <option value="yes" {{ $edit->security_day == 'yes' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="no" {{ $edit->security_day == 'no' ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-8">
                                        <h3>CCTV</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="security_cctv" id="security_cctv"
                                            class="form-select @error('security_cctv') is-invalid @enderror">
                                            <option value="">-- Choose CCTV --</option>
                                            <option value="yes" {{ $edit->security_cctv == 'yes' ? 'selected' : '' }}> Yes
                                            </option>
                                            <option value="no" {{ $edit->security_cctv == 'no' ? 'selected' : '' }}> No
                                            </option>
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <!-- <button type="submit" class="submit_button">Update</button>  -->
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        {{-- VILLA INCLUDE --}}
                        <div class="main">
                            <div class="text">
                                <h2>Villa Include ?</h2>
                                @error('privacy_type')
                                    <label id="privacy_type-error" class="error mt-2 text-danger"
                                        for="privacy_type">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    @if ($edit->pool != null)
                                        <input type="hidden" name="pool_id" value="{{ $edit->pool->id }}" id="">
                                        <div class="form-group">
                                            <label>Pool</label>
                                            <select name="pool_edit" id="pool"
                                                class="form-select @error('pool') is-invalid @enderror">
                                                <option value="">-- Choouse Pool --</option>
                                                <option value="yes" {{ $edit->pool->pool == 'yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="no" {{ $edit->pool->pool == 'no' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type_edit" id="type"
                                                class="form-select @error('type') is-invalid @enderror">
                                                <option value="private" {{ $edit->pool->type == 'private' ? 'selected' : '' }}>
                                                    Private</option>
                                                <option value="shared" {{ $edit->pool->type == 'shared' ? 'selected' : '' }}>
                                                    Shared</option>
                                                <option value="no_pool" {{ $edit->pool->type == 'no_pool' ? 'selected' : '' }}>
                                                    No Pool</option>
                                                <option value="sauna" {{ $edit->pool->type == 'sauna' ? 'selected' : '' }}>
                                                    Sauna</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Size Of Pool</label>
                                            <textarea name="size_of_pool_edit" class="form-control" cols="0" rows="4"
                                                cols="30" rows="10">{{ $edit->pool->size_of_pool }}</textarea>
                                        </div>

                                        <div class="container">
                                            <section class="title-bedroom">
                                                Additional guest</section>
                                                </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                            <label>Max Guests</label>
                                                            <input type="number" name="max_guests"
                                                                value="{{ $edit->max_guests }}" id="max_guests"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Charge per Extra Guest</label>
                                                            <textarea name="extra_guest_charge"
                                                                id="extra_guest_charge" class="form-control" cols="30"
                                                                rows="4">{{ $edit->extra_guest_charge }}</textarea>
                                                        </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @else
                                        <div class="form-group">
                                            <label>Pool</label>
                                            <select name="pool" id="pool"
                                                class="form-select @error('pool') is-invalid @enderror">
                                                <option value="">-- Choouse Pool --</option>
                                                <option value="yes">
                                                    Yes
                                                </option>
                                                <option value="no">
                                                    No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" id="type"
                                                class="form-select @error('type') is-invalid @enderror">
                                                <option value="private">
                                                    Private</option>
                                                <option value="shared">
                                                    Shared</option>
                                                <option value="no_pool">
                                                    No Pool</option>
                                                <option value="sauna">
                                                    Sauna</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Size Of Pool</label>
                                            <textarea name="size_of_pool" class="form-control" cols="0" rows="4" cols="30"
                                                rows="10"></textarea>
                                        </div>

                                        <div class="container">
                                            <section class="title-bedroom">
                                                Additional guest</section>
                                                </div>
                                    <div class="card">
                                            <div class="card-body">
                                        <div class="form-group">
                                                <label>Extra Guest Charge</label>
                                                <textarea name="extra_guest_charge" id="extra_guest_charge"
                                                    class="form-control" cols="30" rows="4"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Max Guests</label>
                                                <input type="number" name="max_guests" id="max_guests"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        </div>

                                        <hr>
                                    @endif
                                    <div id="all-bedroom">
                                        <div class="container">
                                            <section class="title-bedroom">
                                                Bedroom</section>
                                            <button type="button" name="add_image" onclick="tambah_bedroom()"
                                                class="btn-right btn btn-success">Add Bedrooms</button>
                                        </div>
                                        <br> <br> <br>
                                        @if ($edit->bedrooms->count() > 0)
                                        @foreach ($edit->bedrooms as $item)
                                            <div class="card">
                                                <div class="card-body">
                                                    <button type="button" class="btn btn-danger btn-right delete-bedroom"
                                                        data-bedroom="{{ $item->number_of_bedrooms }}"
                                                        data-link="{{ route('admin.villa.destroy_bedroom', ['id' => $item->id]) }}">
                                                        <i class="fa fa-trash pr-2"></i>Delete
                                                    </button>
                                                    <div class="form-group">
                                                        <label>Number Of Bedroom</label>
                                                        <input type="number" name="number_of_bedroom_edit[{{ $item->id }}]"
                                                            value="{{ $item->number_of_bedrooms }}" id="number_of_bedroom"
                                                            class="form-control">
                                                    </div>
                                                    

                                                    <div class="form-group">
                                                        <label>Type Of Bedroom</label>
                                                        <select name="type_of_bedroom_edit[{{ $item->id }}]"
                                                            id="type_of_bedroom"
                                                            class="form-select @error('type_of_bedroom') is-invalid @enderror">
                                                            <option value="double_bed" {{ $item->type_of_bedroom == 'double_bed' ? 'selected' : '' }}>
                                                                Double Bed</option>
                                                            <option value="hollywood_twin" {{ $item->type_of_bedroom == 'hollywood_twin' ? 'selected' : '' }}>
                                                                Hollywood Twin</option>
                                                            <option value="twin" {{ $item->type_of_bedroom == 'twin' ? 'selected' : '' }}>
                                                                Twin
                                                            </option>
                                                            <option value="single" {{ $item->type_of_bedroom == 'single' ? 'selected' : '' }}>
                                                                Single</option>
                                                            <option value="queen" {{ $item->type_of_bedroom == 'queen' ? 'selected' : '' }}>
                                                                Queen
                                                            </option>
                                                            <option value="king" {{ $item->type_of_bedroom == 'king' ? 'selected' : '' }}>
                                                                King
                                                            </option>
                                                            <option value="sofa_bed" {{ $item->type_of_bedroom == 'sofa_bed' ? 'selected' : '' }}>
                                                                Sofa bed
                                                            </option>
                                                            <option value="bunk_bed" {{ $item->type_of_bedroom == 'bunk_bed' ? 'selected' : '' }}>
                                                                Bunk bed
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>People Can Stay Per Room</label>
                                                        <input type="number"
                                                            name="people_can_stay_per_room_edit[{{ $item->id }}]"
                                                            value="{{ $item->people_can_stay_per_room }}"
                                                            id="people_can_stay_per_room" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Type Of Bathroom</label>
                                                        <select name="type_of_bathroom_edit[{{ $item->bathrooms->id }}]"
                                                            id="type_of_bathroom"
                                                            class="form-select @error('type_of_bathroom') is-invalid @enderror">
                                                            <option value="ensuite_bathroom" {{ $item->bathrooms->type_of_bathroom == 'ensuite_bathroom' ? 'selected' : '' }}>
                                                                Ensuite Bathroom</option>
                                                            <option value="guest_bathroom" {{ $item->bathrooms->type_of_bathroom == 'guest_bathroom' ? 'selected' : '' }}>
                                                                Guest Bathroom</option>
                                                            <option value="toilet_only" {{ $item->bathrooms->type_of_bathroom == 'toilet_only' ? 'selected' : '' }}>
                                                                Toilet Only</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                        @endif

                                        <div id="bedrooms-multiple"></div>

                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        {{-- Inclusions --}}
                        <div class="main">
                            <div class="text">
                                <h2>Inclusions ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    @if ($edit->inclusions != null)
                                        <div class="form-group">
                                            <label>Breakfast</label>
                                            <select name="breakfast_edit" id="breakfast"
                                                class="form-select @error('breakfast') is-invalid @enderror">
                                                <option value="">-- Choose Breakfast --</option>
                                                <option value="yes" {{ $edit->inclusions->breakfast == 'yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="no" {{ $edit->inclusions->breakfast == 'no' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Breakfast Description</label>
                                            <textarea name="breakfast_description_edit" id="breakfast_description"
                                                class="form-control" cols="30"
                                                rows="4">{{ $edit->inclusions->breakfast_description }}</textarea>
                                        </div>
                                        <input type="hidden" name="inclusions_id" value="{{ $edit->inclusions->id }}">

                                        <div class="form-group">
                                            <label>Airport</label>
                                            <select name="airport_edit" id="airport"
                                                class="form-select @error('airport') is-invalid @enderror">
                                                <option value="">-- Choose Airport --</option>
                                                <option value="yes" {{ $edit->inclusions->airport == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no" {{ $edit->inclusions->airport == 'no' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Airport Description</label>
                                            <textarea name="airport_description_edit" id="airport_description"
                                                class="form-control" cols="30"
                                                rows="4">{{ $edit->inclusions->airport_description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Massage</label>
                                            <select name="pijet_edit" id="pijet"
                                                class="form-select @error('pijet') is-invalid @enderror">
                                                <option value="">-- Choose Massage --</option>
                                                <option value="yes" {{ $edit->inclusions->pijet == 'yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="no" {{ $edit->inclusions->pijet == 'no' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Pijet Description</label>
                                            <textarea name="pijet_description_edit" id="pijet_description"
                                                class="form-control" cols="30"
                                                rows="4"> {{ $edit->inclusions->pijet_description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Anything Else</label>
                                            <select name="anything_else_edit" class="form-select">
                                                <option value="">-- Choose Anything Else --</option>
                                                <option value="yes" {{ $edit->inclusions->anything_else == 'yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="no" {{ $edit->inclusions->anything_else == 'no' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Anything Else Description</label>
                                            <textarea name="anything_else_description_edit" id="anything_else_description"
                                                class="form-control" cols="30"
                                                rows="4">{{ $edit->inclusions->anything_else_description }}</textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>Breakfast</label>
                                            <select name="breakfast" id="breakfast"
                                                class="form-select @error('breakfast') is-invalid @enderror">
                                                <option value="">-- Choose Breakfast --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Breakfast Description</label>
                                            <textarea name="breakfast_description" id="breakfast_description"
                                                class="form-control" cols="30" rows="4"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Airport</label>
                                            <select name="airport" id="airport"
                                                class="form-select @error('airport') is-invalid @enderror">
                                                <option value="">-- Choose Airport --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Airport Description</label>
                                            <textarea name="airport_description" id="airport_description"
                                                class="form-control" cols="30" rows="4"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Massage</label>
                                            <select name="pijet" id="pijet"
                                                class="form-select @error('pijet') is-invalid @enderror">
                                                <option value="">-- Choose Massage --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Pijet Description</label>
                                            <textarea name="pijet_description" id="pijet_description" class="form-control"
                                                cols="30" rows="4"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Anything Else</label>
                                            <select name="anything_else" class="form-select">
                                                <option value="">-- Choose Anything Else --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Anything Else Description</label>
                                            <textarea name="anything_else_description" id="anything_else_description"
                                                class="form-control" cols="30" rows="4"></textarea>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>



                        {{-- Staff AT villa --}}
                        <div class="main">
                            <div class="text">
                                <h2>Staff At Villa ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    @if ($edit->staff_new != null)
                                        <div class="form-group">
                                            <label>House Keeper</label>
                                            <input type="number" name="house_keeper_edit"
                                                value="{{ $edit->staff_new->house_keeper }}" id="house_keeper"
                                                class="form-control">
                                        </div>

                                        <input type="hidden" name="staff_id" value="{{ $edit->staff_new->id }}" id="">

                                        <div class="form-group">
                                            <label>Satpam</label>
                                            <input type="text" name="satpam_edit" value="{{ $edit->staff_new->satpam }}"
                                                id="satpam" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Manager</label>
                                            <input type="text" name="manager_edit" value="{{ $edit->staff_new->manager }}"
                                                id="manager" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Chef</label>
                                            <input type="text" name="chef_staff_edit" value="{{ $edit->staff_new->chef }}"
                                                id="chef_staff" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Gardener</label>
                                            <input type="text" name="gardener_edit" value="{{ $edit->staff_new->gardener }}"
                                                id="gardener" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Driver</label>
                                            <input type="text" name="driver_edit" value="{{ $edit->staff_new->driver }}"
                                                id="driver" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Other</label>
                                            <input type="text" name="other_edit" value="{{ $edit->staff_new->other }}"
                                                id="other" class="form-control">
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>House Keeper</label>
                                            <input type="number" name="house_keeper" id="house_keeper" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Satpam</label>
                                            <input type="text" name="satpam" id="satpam" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Manager</label>
                                            <input type="text" name="manager" id="manager" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Chef</label>
                                            <input type="text" name="chef_staff" id="chef_staff" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Gardener</label>
                                            <input type="text" name="gardener" id="gardener" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Driver</label>
                                            <input type="text" name="driver" id="driver" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Other</label>
                                            <input type="text" name="other" id="other" class="form-control">
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        {{-- Chef --}}
                        <div class="main">
                            <div class="text">
                                <h2>Chef / Cook ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    @if ($edit->chef != null)
                                        <input type="hidden" name="chef_id" value="{{ $edit->chef->id }}" id="">
                                        <div class="form-group">
                                            <label>Chef / Cook</label>
                                            <select name="chef_edit" id="chef"
                                                class="form-select @error('chef') is-invalid @enderror">
                                                <option value="">-- Choose Cheff --</option>
                                                <option value="yes" {{ $edit->chef->chef == 'yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="no" {{ $edit->chef->chef == 'no' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select name="chef_cost_currency_edit" id="chef_cost_currency"
                                                class="form-select @error('chef_cost_currency') is-invalid @enderror">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}" {{ $edit->chef->chef_cost_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="number" name="cost_edit" value="{{ $edit->chef->cost }}" id="cost"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Information</label>
                                            <textarea name="information_edit" id="information" class="form-control"
                                                cols="30" rows="4">{{ $edit->chef->information }}</textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>Chef / Cook</label>
                                            <select name="chef" id="chef"
                                                class="form-select @error('chef') is-invalid @enderror">
                                                <option value="">-- Choose Chef / Cook --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select name="chef_cost_currency" id="chef_cost_currency"
                                                class="form-select @error('chef_cost_currency') is-invalid @enderror">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="number" name="cost" id="cost" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Information</label>
                                            <textarea name="information" id="information" class="form-control" cols="30"
                                                rows="4"></textarea>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div>

                        {{-- Car And Driver --}}
                        <div class="main">
                            <div class="text">
                                <h2>Car And Driver ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    @if ($edit->car != null)
                                            <input type="hidden" name="car_id" value="{{ $edit->car->id }}">
                                            <div class="form-group">
                                                <label>System For Use</label>
                                                <input type="text" name="system_for_use_edit"
                                                    value="{{ $edit->car->system_for_use }}" id="system_for_use"
                                                    class="form-control">
                                            </div>
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select name="car_currency_edit" id="car_currency"
                                                class="form-select @error('car_currency') is-invalid @enderror">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}" {{ $edit->car->car_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost </label>
                                            <input type="number" name="cost_driver_edit" value="{{ $edit->car->cost }}"
                                                id="cost_driver" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Information</label>
                                            <textarea name="information_car_edit" id="information_car" class="form-control"
                                                cols="30" rows="4">{{ $edit->car->information }}</textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>System For Use</label>
                                            <input type="text" name="system_for_use" id="system_for_use" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select name="car_currency" id="car_currency"
                                                class="form-select @error('car_currency') is-invalid @enderror">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost </label>
                                            <input type="number" name="cost_driver" id="cost_driver" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Information</label>
                                            <textarea name="information_car" id="information_car" class="form-control" cols="30"
                                                rows="4"></textarea>
                                        </div>
                                    @endif

                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button type="button" class="back_button">Back</button>
                            <button type="button" class="next_button">Next Step</button>
                            <button type="submit" class="btn btn-info">Save Draft</button>
                        </div>
                    </div>

                    {{-- Album --}}
                    <div class="main">
                        <div class="text">
                            <h2>Albums ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">
                                <section>
                                    <button type="button" name="add_image" onclick="add_nama_album()"
                                        class="btn-right btn btn-outline-success">Add Album</button>
                                </section>
                                @if (count($edit->album) != 0)
                                
                                <div id="all-nama-album">
                                    @foreach ($edit->album as $item)
                                            <div class="card">
                                                <div class="card-body">
                                                    <button type="button"
                                                        class="btn btn-right btn-sm btn-outline-danger hapus-album"
                                                        data-value="{{ $item->nama }}"
                                                        data-link="{{ route('admin.villa.destroy_album', ['id' => $item->id]) }}">Delete
                                                    </button>
                                                    <div class="form-group">
                                                        <label>Nama Album</label>
                                                        <input type="text" name="nama_album_edit[{{ $item->id }}]"
                                                            id="nama_album" value="{{$item->nama}}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kategori Album</label>
                                                        <select name="album_category[{{ $item->id }}]" id="album-category"
                                                            class="form-select @error('album_category') is-invalid @enderror">
                                                            @foreach ($album_categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                @if ($category->id == $item->album_category_id)
                                                                    selected
                                                                @endif
                                                                >
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="count_album" id="count_album" value="0">
                                                    <div class="form-group">
                                                        <label>Deskripsi Album</label>
                                                        <textarea name="deskripsi_album_edit[{{ $item->id }}]"
                                                            id="deskripsi_album" class="form-control" cols="30"
                                                            rows="4">{{$item->deskripsi}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Album Galeri</label>
                                                    </div>
                                                    <div class="table-responsive">

                                                        <table class="table-bordered" style="width: 100%;">
                                                            <thead>
                                                                <tr style="padding: 10px; text-align:center;">
                                                                    <th style="padding: 12px">Gambar</th>
                                                                    <th style="padding: 12px">Caption</th>
                                                                    <th style="padding: 12px">No. Urut</th>
                                                                    <th style="padding: 12px">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="all-album-{{$item->id}}" style="padding:10px;">
                                                                @foreach ($item->galeri_album as $val)
                                                                    <tr>
                                                                        <input type="hidden" name="galeri_album_edit[{{ $val->id }}]" value="{{ $val->id }}">
                                                                        <td style="padding: 15px;">
                                                                            <input type="file" class="use-dropify"
                                                                                name="image_album_edit[{{ $val->id }}]"
                                                                                data-default-file="{{ asset('uploads/' . $val->image) }}">
                                                                        </td>
                                                                        <td>
                                                                            <textarea name="title_album_edit[{{ $val->id }}]"
                                                                                class="form-control" cols="30"
                                                                                rows="12">{{ $val->title }}</textarea>
                                                                        </td>
                                                                        <td>
                                                                            <textarea name="order_number_edit[{{ $val->id }}]"
                                                                                class="form-control" cols="30"
                                                                                rows="12">{{ $val->order_number }}</textarea>
                                                                        </td>
                                                                        <td align="right">
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger btn-block hapus-galeri"
                                                                                data-title="{{ $val->title }}"
                                                                                data-link="{{ route('admin.villa.destroy_album_galeri', ['id' => $val->id]) }}">Delete
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block mb-3"
                                                        onclick="tambah_album({{$item->id}})">Tambah</button>
                                                </div>
                                            </div>
                                            <br>
                                            @endforeach
                                    <div id="album-multiple"></div>
                                </div>
                               
                                @else
                                <div id="all-nama-album">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Nama Album</label>
                                                    <input type="text" name="nama_album[]" id="nama_album"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kategori Album</label>
                                                    <select name="album_category[]" id="album-category"
                                                        class="form-select @error('album_category') is-invalid @enderror">
                                                        @foreach ($album_categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="hidden" name="count_album" id="count_album"
                                                    value="0">
                                                <div class="form-group">
                                                    <label>Deskripsi Album</label>
                                                    <textarea name="deskripsi_album[]" id="deskripsi_album" class="form-control" cols="30" rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Album Galeri</label>
                                                </div>
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead>
                                                        <tr style="padding: 10px; text-align:center;">
                                                            <th style="padding: 12px">Gambar</th>
                                                            <th style="padding: 12px">Caption</th>
                                                            <th style="padding: 12px">No. Urut</th>
                                                            <th style="padding: 12px">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="all-album-0" style="padding:10px;">
                                                        <tr>
                                                            <td style="padding: 15px;">
                                                                <input type="file" class="use-dropify"
                                                                    name="image_album[0][]">
                                                            </td>
                                                            <td>
                                                                <textarea name="title_album[0][]" class="form-control" cols="30" rows="12"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="order_number[0][]" class="form-control" cols="30" rows="12"></textarea>
                                                            </td>
                                                            <td align="right">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm btn-block mb-3"
                                                        onclick="tambah_album(0)">Tambah</button>
                                        </div>
                                        <br>
                                        <div id="album-multiple"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button type="button" class="back_button">Back</button>
                            <button type="button" class="next_button">Next Step</button>
                            <button type="submit" class="btn btn-info">Save Draft</button>
                        </div>
                    </div>

                    {{-- Floorplan --}}
                    <div class="main">
                        <div class="text">
                            <h2>Floorplan ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">

                                @if ($edit->floorplan != null)
                                    <input type="hidden" name="floorplan_id" value="{{ $edit->floorplan->id }}" id="">
                                    <div class="form-group">
                                        <label>Name Floorplan</label>
                                        <input type="text" name="nama_floorplan_edit" value="{{ $edit->floorplan->nama }}"
                                            id="nama_floorplan" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Floorplan</label>
                                        <textarea name="deskripsi_edit" id="deskripsi" class="form-control" cols="30"
                                            rows="4">{{ $edit->floorplan->deskripsi }}</textarea>
                                    </div>

                                    <div class="container">
                                        <section class="title-bedroom">Gambar Floorplan</section>
                                    </div> <br>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-floorplan">
                                            @foreach ($edit->floorplan->galeri_floorplan as $item)
                                                <tr>
                                                    <td>
                                                        <input type="file" id="input-file-now" class="use-dropify"
                                                            name="image_floorplan_edit[{{ $item->id }}]"
                                                            data-default-file="{{ asset('uploads/' . $item->gambar) }}">
                                                    </td>
                                                    <td>
                                                        <textarea name="deskripsi_floorplan_edit[{{ $item->id }}]"
                                                            class="form-control" cols="30"
                                                            rows="8">{{ $item->deskripsi }}</textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger btn-block delete-floorplan"
                                                            data-deskripsi="{{ $item->deskripsi }}"
                                                            data-link="{{ route('admin.villa.destroy_floorplan', ['id' => $item->id]) }}">
                                                            <i class="fa fa-trash pr-2"></i>Delete
                                                        </button>
                                                    </td>
                                            @endforeach

                                                <!-- Baris tambahan untuk menambah gambar baru -->
                                            <tr id="new-row">
                                                <td>
                                                    <input type="file" class="use-dropify" name="new_image_floorplan[]">
                                                </td>
                                                <td>
                                                    <textarea name="new_deskripsi_floorplan[]" class="form-control"
                                                        cols="30" rows="8"></textarea>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-table-row"
                                                        type="button">Hapus</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-primary btn-sm btn-block"
                                        onclick="tambah_floorplan_edit()">Tambah</button>
                                @else
                                    <div class="form-group">
                                        <label>Name Floorplan</label>
                                        <input type="text" name="nama_floorplan" id="nama_floorplan" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Floorplan</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30"
                                            rows="4"></textarea>
                                    </div>

                                    <div class="container">
                                        <section class="title-bedroom">Gambar Floorplan</section>
                                    </div> <br>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-floorplan">
                                            <tr>
                                                <td>
                                                    <input type="file" class="use-dropify" name="image_floorplan[]">
                                                </td>
                                                <td>
                                                    <textarea name="deskripsi_floorplan[]" class="form-control" cols="30"
                                                        rows="8"></textarea>
                                                </td>
                                                <td align="right">
                                                    <button type="button" class="btn btn-primary btn-sm mb-3"
                                                        onclick="tambah_floorplan()">Tambah</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button type="button" class="back_button">Back</button>
                            <button type="button" class="next_button">Next Step</button>
                            <button type="submit" class="btn btn-info">Save Draft</button>
                        </div>
                    </div>

                    {{-- Pricing --}}
                    <div class="main">
                        <div class="text">
                            <h2>Pricing ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">

                                @if ($edit->pricing != null)
                                    <input type="hidden" name="pricing_id" value="{{ $edit->pricing->id }}" id="">
                                    <div class="form-group">
                                        <label>Monthly Rental</label>
                                        <select name="monthly_rental_edit" class="form-select">
                                            <option value="">-- Choose Monthly Rental --</option>
                                            <option value="yes" {{ $edit->pricing->monthly_rental == 'yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="no" {{ $edit->pricing->monthly_rental == 'no' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Monthly Description</label>
                                        <textarea name="monthly_description_edit" id="monthly_description"
                                            class="form-control" cols="30"
                                            rows="4">{{ $edit->pricing->monthly_description }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-3">
                                            <label>Monthly Currency</label>
                                            <select name="monthly_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->monthly_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Monthly Cost</label>
                                            <input type="number" name="monthly_cost" class="form-control"
                                            value="{{ $edit->pricing->monthly_cost }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Yearly Rental</label>
                                        <select name="yearly_rental_edit" class="form-select">
                                            <option value="">-- Choose Yearly Rental --</option>
                                            <option value="yes" {{ $edit->pricing->yearly_rental == 'yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="no" {{ $edit->pricing->yearly_rental == 'no' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Yearly Description</label>
                                        <textarea name="yearly_description_edit" id="yearly_description"
                                            class="form-control" cols="30"
                                            rows="4">{{ $edit->pricing->yearly_description }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-3">
                                            <label>Yearly Currency</label>
                                            <select name="yearly_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->yearly_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Yearly Cost</label>
                                            <input type="number" name="yearly_cost" class="form-control"
                                            value="{{ $edit->pricing->yearly_cost }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Available For Sales</label>
                                        <select name="available_for_sales_edit" id="available_for_sales"
                                            class="form-select @error('available_for_sales_edit') is-invalid @enderror">
                                            <option value="">-- Choose Available For Sales --</option>
                                            <option value="yes" {{ $edit->pricing->available_for_sales_rental == 'yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="no" {{ $edit->pricing->available_for_sales_rental == 'no' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Available For Sales Description</label>
                                        <textarea name="available_for_sales_description_edit"
                                            id="available_for_sales_description" class="form-control" cols="30"
                                            rows="4">{{ $edit->pricing->available_for_sales_description }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-5">
                                            <label>Available For Sales Currency</label>
                                            <select name="available_for_sales_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->available_for_sales_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Available For Sales Cost</label>
                                            <input type="number" name="available_for_sales_cost" class="form-control"
                                            value="{{ $edit->pricing->available_for_sales_cost }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Long Term Rental</label>
                                        <textarea name="long_term_rental_edit" id="long_term_rental" class="form-control"
                                            cols="30" rows="4">{{ $edit->pricing->long_term_rental }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-5">
                                            <label>Long Term Rental Currency</label>
                                            <select name="long_term_rental_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->long_term_rental_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Long Term Rental Cost</label>
                                            <input type="number" name="long_term_rental_cost" class="form-control"
                                            value="{{ $edit->pricing->long_term_rental_cost }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Long Term Sales</label>
                                        <textarea name="long_term_sales_edit" id="long_term_sales" class="form-control"
                                            cols="30" rows="4">{{ $edit->pricing->long_term_rental }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Freehold</label>
                                        <select name="freehold_edit" id="freehold"
                                            class="form-select @error('freehold') is-invalid @enderror">
                                            <option value="">-- Choose Freehold --</option>
                                            <option value="yes" {{ $edit->pricing->freehold == 'yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="no" {{ $edit->pricing->freehold == 'no' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Freehold Description</label>
                                        <textarea name="freehold_description_edit" id="freehold_description"
                                            class="form-control" cols="30"
                                            rows="4">{{ $edit->pricing->freehold_description }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-4">
                                            <label>Freehold Currency</label>
                                            <select name="freehold_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->freehold_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Freehold Cost</label>
                                            <input type="number" name="freehold_cost" class="form-control"
                                            value="{{ $edit->pricing->freehold_cost }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Leasehold</label>
                                        <select name="leasehold_edit" id="leasehold"
                                            class="form-select @error('leasehold') is-invalid @enderror">
                                            <option value="">-- Choose leasehold --</option>
                                            <option value="yes" {{ $edit->pricing->leasehold == 'yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="no" {{ $edit->pricing->leasehold == 'no' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Leasehold Description</label>
                                        <textarea name="leasehold_description_edit" id="leasehold_description"
                                            class="form-control" cols="30"
                                            rows="4">{{ $edit->pricing->leasehold_description }}</textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-4">
                                            <label>Leasehold Currency</label>
                                            <select name="leasehold_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}"
                                                    {{ $edit->pricing->leasehold_currency == $currency->code ? 'selected' : '' }}>
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Leasehold Cost</label>
                                            <input type="number" name="leasehold_cost" class="form-control"
                                            value="{{ $edit->pricing->leasehold_cost }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Leasehold Available Until</label>
                                        <select name="leasehold_available_until" id="leasehold"
                                            class="form-select @error('leasehold') is-invalid @enderror">
                                            <option value="">-- Choose year --</option>
                                            @foreach ($year_list as $year)
                                            <option value="{{ $year }}"
                                            {{ $edit->pricing->leasehold_available_until == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Monthly Rental</label>
                                        <select name="monthly_rental" class="form-select">
                                            <option value="">-- Choose Monthly Rental --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Monthly Description</label>
                                        <textarea name="monthly_description" id="monthly_description" class="form-control"
                                            cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-3">
                                            <label>Monthly Currency</label>
                                            <select name="monthly_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Monthly Cost</label>
                                            <input type="number" name="monthly_cost" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Yearly Rental</label>
                                        <select name="yearly_rental" class="form-select">
                                            <option value="">-- Choose Yearly Rental --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Yearly Description</label>
                                        <textarea name="yearly_description" id="yearly_description" class="form-control"
                                            cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-3">
                                            <label>Yearly Currency</label>
                                            <select name="yearly_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Yearly Cost</label>
                                            <input type="number" name="yearly_cost" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Available For Sales</label>
                                        <select name="available_for_sales" id="available_for_sales"
                                            class="form-select @error('available_for_sales') is-invalid @enderror">
                                            <option value="">-- Choose Available For Sales --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Available For Sales Description</label>
                                        <textarea name="available_for_sales_description"
                                            id="available_for_sales_description" class="form-control" cols="30"
                                            rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-5">
                                            <label>Available For Sales Currency</label>
                                            <select name="available_for_sales_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Available For Sales Cost</label>
                                            <input type="number" name="available_for_sales_cost" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Long Term Rental</label>
                                        <textarea name="long_term_rental" id="long_term_rental" class="form-control"
                                            cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-5">
                                            <label>Long Term Rental Currency</label>
                                            <select name="long_term_rental_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Long Term Rental Cost</label>
                                            <input type="number" name="long_term_rental_cost" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Long Term Sales</label>
                                        <textarea name="long_term_sales" id="long_term_sales" class="form-control" cols="30"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Freehold</label>
                                        <select name="freehold" id="freehold"
                                            class="form-select @error('freehold') is-invalid @enderror">
                                            <option value="">-- Choose Freehold --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Freehold Description</label>
                                        <textarea name="freehold_description" id="freehold_description"
                                            class="form-control" cols="30"
                                            rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-4">
                                            <label>Freehold Currency</label>
                                            <select name="freehold_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Freehold Cost</label>
                                            <input type="number" name="freehold_cost" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Leasehold</label>
                                        <select name="leasehold" id="leasehold"
                                            class="form-select @error('leasehold') is-invalid @enderror">
                                            <option value="">-- Choose leasehold --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Leasehold Description</label>
                                        <textarea name="leasehold_description" id="leasehold_description"
                                            class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group row pt-0">
                                        <div class="col-4">
                                            <label>Leasehold Currency</label>
                                            <select name="leasehold_currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                @foreach ($master_currency as $currency)
                                                    <option value="{{ $currency->code }}">
                                                        {{ $currency->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Leasehold Cost</label>
                                            <input type="number" name="leasehold_cost" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Leasehold Available Until</label>
                                        <select name="leasehold_available_until" id="leasehold"
                                            class="form-select @error('leasehold') is-invalid @enderror">
                                            <option value="">-- Choose year --</option>
                                            @foreach ($year_list as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

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
    <div class="modal fade" id="mod-delete-galeri" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="form-delete-galery" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete gallery ?
                        <img src="" alt="" id="delete-image-galeri" width="100%">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mod-delete-floorplan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="form-delete-floorplan" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete floosplan ? <b id="floorplan_deskripsi"></b>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mod-delete-bedrooms" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="form-delete-bedrooms" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete number of bedrooms ? <b id="number_bedroom"></b>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mod-delete-album" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="form-delete-album" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete album ? <b id="nama-album"></b>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mod-delete-galeri-album" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="form-delete-galeri-album" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete galeri ? <b id="nama-galeri"></b>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section id="villaexperience" class="m-4 pt-4"></section>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Villa Experience</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Retreats Villa
                        </div>
                        <div class="card-footer">
                            @if ($edit->retreats == null)
                                <a href="{{ route('admin.villa.create_retreats', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_retreats', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-retreats">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_retreats', $edit->retreats->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-retreats" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Retreats</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Wedding Villa
                        </div>
                        <div class="card-footer">
                            @if ($edit->wedding == null)
                                <a href="{{ route('admin.villa.create_wedding', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_wedding', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-wedding">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_wedding', $edit->wedding->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-wedding" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Wedding</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Mountains Villa
                        </div>
                        <div class="card-footer">
                            @if ($edit->mountain == null)
                                <a href="{{ route('admin.villa.create_mountain', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_mountain', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-mountain">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_mountain', $edit->mountain->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-mountain" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Montains Villa</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Close To The Club
                        </div>
                        <div class="card-footer">
                            @if ($edit->close_clubs->first() == null)
                                <a href="{{ route('admin.villa.create_close', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_close', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-close">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_close', $edit->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-close" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Close To The Clubs</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Family Villa
                        </div>
                        <div class="card-footer">
                            @if ($edit->family == null)
                                <a href="{{ route('admin.villa.create_family', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_family', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-family">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_family', $edit->family->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-family" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Family</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body">
                            Beach Villa
                        </div>
                        <div class="card-footer">
                            @if ($edit->beach == null)
                                <a href="{{ route('admin.villa.create_beach', $edit->id) }}"
                                    class="btn btn-primary btn-block">Tambah</a>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admin.villa.edit_beach', $edit->id) }}"
                                            class="btn btn-success btn-block"> Edit</a>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete-beach">
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.villa.destroy_beach', $edit->beach->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="delete-beach" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data <b>Beach</b>
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{-- RATES --}}
    <section id="editrates" class="m-4 pt-4"></section>
    {{-- <div class="m-4" id="edit-rates"></div> --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Rates</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('permission-create')
                {{-- <a href="{{ route('admin.villa.create_rate', $edit->id) }}">
                    <button class="btn btn-primary">Tambah</button>
                </a> --}}
                <button type="button" id="openFormRatesAdd" class="btn btn-primary add-rates" data-target="#formRatesAdd"
                    data-action-rates="{{ route('admin.villa.store_rate', $edit->id) }}" data-toggle="modal">Tambah</button>
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
                                                                                    <div class="card-status card-status-left {{ $bg }} br-bl-7 br-tl-7">
                                                                                    </div>
                                                                                    <div class="card-body d-flex flex-column p-3">
                                                                                        <h4><a href="##"
                                                                                            onclick="changedate('{{ $item->start_date }}')">{{ $item->details }}</a>
                                                                                        </h4>
                                                                                        <b>{{ ucfirst(str_replace('_', ' ', $item->type)) }}</b>
                                                                                        <div class="text-muted">
                                                                                            <b>Start</b> =
                                                                                            {{ date('d-m-Y', strtotime($item->start_date)) }} |
                                                                                            <b>End</b> = {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                                                        </div>
                                                                                        {{-- <div class="text-muted">
                                                                                            <b>Price</b> = {{ $item->currency . ' ' . $item->price }}
                                                                                        </div> --}}
                                                                                        {{-- <p class="card-custom-icon {{ $fn }}">
                                                                                        </p> --}}
                                                                                        <div class="text-muted" style="text-align: right;">
                                                                                            @can('villa-edit')
                                                                                                {{-- <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-sm btn-outline-success">Edit
                                                                                                    </button>
                                                                                                </a> --}}
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-outline-success edit-rates"
                                                                                                    data-id-rates="{{ $item->id }}"
                                                                                                    data-action-rates="{{ route('admin.villa.update_rate', $item->id) }}"
                                                                                                    >Edit</button>
                                                                                            @endcan
                                                                                            @can('villa-delete')
                                                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                                                    data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                                                                    Delete
                                                                                                </button>
                                                                                            @endcan
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- Modal -->
                                                                                    <form action="{{ route('admin.villa.destroy_rate', $item->id) }}"
                                                                                        method="POST" class="d-inline">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1"
                                                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                                                            aria-hidden="true">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                                                            Delete
                                                                                                        </h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                                            aria-label="Close">
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

    {{-- TAMBAH RATES --}}
    <form method="POST" action="{{ route('admin.villa.store_rate', $edit->id) }}" class="card-body" id="formRatesAdd" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-add-rates" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Rates</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="villaId" value="{{ $edit->id }}">
                                        <input type="hidden" name="ratesJson">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="ratesType"
                                                class="form-control @error('type') is-invalid @enderror">
                                                @if (@$edit_mode)
                                                    <option value="base_season"{{ $rate->type == 'base_season' ? 'selected' : '' }}>Base season
                                                    <option value="low_season"{{ $rate->type == 'low_season' ? 'selected' : '' }}>Low season
                                                    <option value="high_season"{{ $rate->type == 'high_season' ? 'selected' : '' }}>High season
                                                    <option value="peak_season"{{ $rate->type == 'peak_season' ? 'selected' : '' }}>Peak season
                                                    <option value="shoulder_season"{{ $rate->type == 'shoulder_season' ? 'selected' : '' }}>Shoulder season
                                                    <option value="special_rate"{{ $rate->type == 'special_rate' ? 'selected' : '' }}>Special rate
                                                @else
                                                    <option value="base_season">Base season
                                                    <option value="low_season">Low season
                                                    <option value="high_season">High season
                                                    <option value="peak_season">Peak season
                                                    <option value="shoulder_season">Shoulder season
                                                    <option value="special_rate">Special rate
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Details</label>
                                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Insert details" name="ratesDetails"
                                                value="{{ @$edit_mode ? $rate->details : old('details') }}">
                                            @error('name')
                                                <label id="name-error" class="text-danger pl-3"
                                                    for="name">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        {{-- ADD ROOMS --}}
                                        <hr class="border border-2 opacity-75">
                                        <div class="d-flex mb-4">
                                            <span id="" class="flex-grow-1">Add Rooms</span>
                                            <button id="addRoomBtn" class="btn btn-primary" type="button" onclick="createRoomsField()">Add</button>
                                        </div>
                                        <div id="rooms-container">
                                            <div name="form-add-room" class="d-flex align-items-end">

                                                <div class="form-group" style="width: 30%">
                                                    <label>Room</label>
                                                    <input type="number"
                                                        class="form-control  @error('room') is-invalid @enderror"
                                                        placeholder="Insert room" name="room"
                                                        value="{{ @$edit_mode ? $rate->room : old('room') }}"
                                                        min="0">
                                                    @error('room')
                                                        <label id="room-error" class="text-danger pl-3"
                                                            for="room">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <select 
                                                name="currency"
                                                class="form-select currency-select ml-1" 
                                                style="height: 36px; margin-bottom: 16px; width: 20%" 
                                                aria-label="Default select example">
                                                    {{-- <option value="IDR" id="currency-option">IDR</option> --}}
                                                </select>

                                                {{-- <div id="currency-select" class="form-select currency-select ml-1" 
                                                style="height: 36px; margin-bottom: 16px; width: 15%" 
                                                aria-label="Default select example">
                                                </div> --}}

                                                <div class="form-group ml-1 flex-grow-1">
                                                    <label>Price</label>
                                                    <input type="number"
                                                        class="form-control  @error('price') is-invalid @enderror"
                                                        placeholder="Insert price" name="price"
                                                        value="{{ @$edit_mode ? $rate->price : old('price') }}"
                                                        min="0">
                                                    @error('price')
                                                        <label id="price-error" class="text-danger pl-3"
                                                            for="price">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <button onclick="deleteRoom()" name="deleteRoomBtn" type="button" class="btn btn-danger border ml-1" style="height: 36px; margin-bottom: 16px">
                                                    X <span class="caret"></span>
                                                </button>
                                            </div>
                                        </div>
                                        {{-- CLOSE ADD ROOMS --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date"
                                                class="form-control  @error('start_date') is-invalid @enderror"
                                                placeholder="Insert your start date" name="start_date"
                                                value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->start_date)) : old('start_date') }}">
                                            @error('start_date')
                                                <label id="start_date-error" class="text-danger pl-3"
                                                    for="start_date">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date"
                                                class="form-control  @error('end_date') is-invalid @enderror"
                                                placeholder="Insert your end date" name="end_date"
                                                value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->end_date)) : old('end_date') }}">
                                            @error('end_date')
                                                <label id="end_date-error" class="text-danger pl-3"
                                                    for="end_date">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="addMethodRates" name="_method" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateRatesBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- EDIT RATES --}}
    {{-- <form method="POST" action="" class="card-body" id="formRatesEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal fade" id="modal-edit-rates" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Rates</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Insert your name" name="name" id="nameRates"
                                                value="{{ @$edit_mode ? $rate->name : old('name') }}">
                                            @error('name')
                                                <label id="name-error" class="text-danger pl-3"
                                                    for="name">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number"
                                                class="form-control  @error('price') is-invalid @enderror"
                                                placeholder="Insert your price" name="price" id="priceRates"
                                                value="{{ @$edit_mode ? $rate->price : old('price') }}">
                                            @error('price')
                                                <label id="price-error" class="text-danger pl-3"
                                                    for="price">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control @error('type') is-invalid @enderror"
                                                id="typeRates">
                                                @if (@$edit_mode)
                                                    <option value="low" {{ $rate->type == 'low' ? 'selected' : '' }}>Low</option>
                                                    <option value="base" {{ $rate->type == 'base' ? 'selected' : '' }}>Base</option>
                                                    <option value="high" {{ $rate->type == 'high' ? 'selected' : '' }}>High</option>
                                                    <option value="peak" {{ $rate->type == 'peak' ? 'selected' : '' }}>Peak</option>
                                                    <option value="low_season"{{ $rate->type == 'low_season' ? 'selected' : '' }}>Low season</option>
                                                    <option value="high_season"{{ $rate->type == 'high_season' ? 'selected' : '' }}>High season</option>
                                                    <option value="special_rate"{{ $rate->type == 'special_rate' ? 'selected' : '' }}>Special rate</option>
                                                    <option value="shoulder_season"{{ $rate->type == 'shoulder_season' ? 'selected' : '' }}>Shoulder season</option>
                                                    <option value="peak_season"{{ $rate->type == 'peak_season' ? 'selected' : '' }}>Peak season</option>
                                                @else
                                                    <option value="low">Low</option>
                                                    <option value="base">Base</option>
                                                    <option value="high">High</option>
                                                    <option value="peak">Peak</option>
                                                    <option value="low_season">Low_season</option>
                                                    <option value="high_season">High season</option>
                                                    <option value="special_rate">Special rate</option>
                                                    <option value="shoulder_season">Shoulder season</option>
                                                    <option value="peak_season">Peak season</option>
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
                                            <label>Start Datess</label>
                                            <input type="date" class="form-control" id="starRates" name="start_date"
                                                placeholder="">
                                            @error('start_date')
                                                <label id="start_date-error" class="text-danger pl-3"
                                                    for="start_date">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" id="endRates" name="end_date"
                                                placeholder="">
                                            @error('end_date')
                                                <label id="end_date-error" class="text-danger pl-3"
                                                    for="end_date">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="editMethodRates" name="_method" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}
    <input type="text" id="id_villa" value="{{ $edit->id }}" hidden>


    {{-- Check Availablity --}}
    <section id="editrates" class="m-4 pt-4"></section>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Check Availablity</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('permission-create')
                {{-- <a href="{{ route('admin.villa.create_rate', $edit->id) }}">
                    <button class="btn btn-primary">Tambah</button>
                </a> --}}
                <button type="button" class="btn btn-primary add-ical" data-target="#formIcalAdd"
                    data-action-ical="{{ route('admin.calendar.import', $edit->id) }}" data-toggle="modal">Tambah</button>
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
                                <div class="col-md-12">
                                    <div class="main-content-body main-content-body-calendar card-body border-left">
                                        <div class="main-calendar" id="calendar-ical"></div>
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


    <div class="modal fade" id="modal-add-ical" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="" class="card-body" id="formIcalAdd" enctype="multipart/form-data">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Ical</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File Ical</label>
                            <input type="file" class="use-dropify  @error('ical') is-invalid @enderror"
                                placeholder="Insert your name" name="ical">
                            @error('ical')
                                <label id="ical-error" class="text-danger pl-3" for="ical">{{ $message }}</label>
                            @enderror
                            {{-- <input type="text" class="form-control @error('link') is-invalid @enderror"
                                placeholder="Insert your name" name="link">
                            @error('name')
                            <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="addMethodRates" name="_method" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection
@section('include-css')
<style>
    html {
        scroll-behavior: smooth;
    }
    .text h2{
        font-weight:400;
    }

    .btn-info {
        color: #212529;
        background-color: #66d1d1 !important;
        border-color: #66d1d1 !important;
    }

    .title-bedroom {
        text-align: center;
        font-size: 17px;
        font-weight: 900;
    }

    .btn-right {
        /* Atur tombol di sebelah kanan */
        float: right;
        /* Anda dapat menyesuaikan properti lain seperti margin, padding, dll. */
        margin-left: 10px;
        margin-bottom: 15px;
        /* Tambahkan margin jika diperlukan */
    }

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
<link href="{{ asset('admin/plugins/fullcalendar/fullcalendar.css') }}" rel='stylesheet' />
<link href="{{ asset('admin/plugins/fullcalendar/fullcalendar.print.min.css') }}" rel='stylesheet' media='print' />
<!--Mutipleselect css-->
<link rel="stylesheet" href="{{ asset('admin/plugins/multipleselect/multiple-select.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/plugins/sumoselect/sumoselect.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/multi/multi.min.css') }}">


<link rel="stylesheet" href="{{ asset('admin/plugins/wizard/wizard.css') }}">
{{-- BUtton --}}
<style>
    .parent {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .parent button {
        background-color: #00ac00;
        color: white;
        border: none;
        padding: 5px;
        font-size: 31px;
        height: 130px;
        width: 130px;
        box-shadow: 0 2px 4px darkslategray;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .parent button:active {
        background-color: #00ac00;
        box-shadow: 0 0 2px darkslategray;
        transform: translateY(2px);
    }

    .parent button:not(:first-child) {
        margin-top: 10px;
    }

    .round-6 {
        border-radius: 70%;
    }
</style>
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
        height: 210px;
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

    /* TOAST */
    .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
    .toast {
        display: none;
        min-width: 250px;
        margin-bottom: 10px;
        padding: 15px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .toast-success {
        border-color: #5cb85c;
        background-color: #dff0d8;
    }
    .toast-error {
        border-color: #d9534f;
        background-color: #f2dede;
    }
    /* END TOAST */

</style>
@endsection
@section('include-js')
<script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
<script>
    $(".use-dropify").dropify();
    $(function () {
        'use strict';

        $('#myDropify').dropify();
    });
    var url = window.location;
    // console.log(url.hash);

    // document.getElementById(url.hash.substring(1)).scrollIntoView({ behavior: 'smooth' });
</script>
<script src="{{ asset('admin/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/js/select2.js') }}"></script>
<script src="{{ asset('admin/plugins/multipleselect/multiple-select.js') }}"></script>
<script src="{{ asset('admin/plugins/multipleselect/multi-select.js') }}"></script>
<script src="{{ asset('admin/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/multi/multi.min.js') }}"></script>
<script src="{{ asset('admin/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('admin/events.js') }}"></script>
<script src="{{ asset('admin/events-ical.js') }}"></script>
<script src="{{ asset('admin/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>
<script src="{{ asset('admin/js/formelementadvnced.js') }}"></script>

<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>

{{--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
<script type="text/javascript" src="{{ asset('admin/plugins/wizard/wizard.js') }}"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
<script>

    var next_click = document.querySelectorAll(".next_button");
    var main_form = document.querySelectorAll(".main");
    var step_list = document.querySelectorAll(".progress-bar-wizard li");
    var num = document.querySelector(".step-number");
    let formnumber = 0;
    function next_jump(e) {
        formnumber = e;
        updateform();
        progress_forward_side();
        // progress_backward_side();
        contentchange();

    }

    next_click.forEach(function (next_click_form) {
        next_click_form.addEventListener('click', function () {
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
    back_click.forEach(function (back_click_form) {
        back_click_form.addEventListener('click', function () {
            formnumber--;
            updateform();
            progress_backward();
            contentchange();
        });
    });

    var username = document.querySelector("#user_name");
    var shownname = document.querySelector(".shown_name");


    var submit_click = document.querySelectorAll(".submit_button");
    submit_click.forEach(function (submit_click_form) {
        submit_click_form.addEventListener('click', function () {
            shownname.innerHTML = username.value;
            formnumber++;
            updateform();
        });
    });

    // var heart = document.querySelector(".fa-heart");
    // heart.addEventListener('click', function () {
    //     heart.classList.toggle('heart');
    // });


    // var share = document.querySelector(".fa-share-alt");
    // share.addEventListener('click', function () {
    //     share.classList.toggle('share');
    // });



    function updateform() {
        main_form.forEach(function (mainform_number) {
            mainform_number.classList.remove('active');
        })
        main_form[formnumber].classList.add('active');
    }

    function progress_forward() {
        num.innerHTML = formnumber + 1;
        step_list[formnumber].classList.add('active');
    }
    function progress_forward_side() {
        [].forEach.call(step_list, function (el) {
            el.classList.remove("active");
        });
        for (let index = 0; index <= formnumber; index++) {
            step_list[index].classList.add('active');
        }
        // step_list[formnumber].classList.add('active');
        num.innerHTML = formnumber + 1;
    }

    function progress_backward() {
        var form_num = formnumber + 1;
        step_list[form_num].classList.remove('active');
        num.innerHTML = form_num;
    }

    var step_num_content = document.querySelectorAll(".step-number-content");

    function contentchange() {
        step_num_content.forEach(function (content) {
            content.classList.remove('active');
            content.classList.add('d-none');
        });
        step_num_content[formnumber].classList.add('active');
    }


    function validateform() {
        validate = true;
        var validate_inputs = document.querySelectorAll(".main.active input");
        validate_inputs.forEach(function (vaildate_input) {
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
    function convertToSlug(Text) {
        return Text.toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w-]+/g, "");
    }
    function gen_villa_code() {
        // var name = $('#villa-name').val();
        // var area = $("#area option:selected").text();
        // var lokasi = $("#lokasi option:selected").text();
        // var sublokasi = $("#subLokasi option:selected").text();
        // var bedroom = $("#bedroom-qty").val();
        // var code = area.toLowerCase() + '/' + lokasi.toLowerCase() + '/' + sublokasi.toLowerCase() + '/' + bedroom + '-bedroom/' + convertToSlug(name);
        // console.log(code);
        // $('#villa-code').val(code);
    }
</script>

{{-- ALBUMS --}}
<script>
    var i = 0;

    function tambah_album() {
        var html = '';
        html += '<div class="col-md-3" style="margin-bottom: 10px">';
        html += '  <input type="file" class="dropify" data-height="180"  name="image_album[]">';
        html += '  <button class="btn btn-danger btn-sm btn-block delete-album" type="button">Hapus</button>';
        html += '</div>';
        // html += '<p> baru</p>';
        document.getElementById("view-image-album").insertAdjacentHTML("afterend", html);
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
    $("#all-album").on('click', '.delete-album', function () {
        $(this).closest('div').remove();
    });

    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    })
</script>

<script>
    function tambah_album(id) {
        var i = id;
        // console.log(id);
        var html = '';
        html += `<tr>
                        <td style="padding: 15px;">
                            <input type="file" class="use-dropify" name="image_album[${i}][]">
                        </td>
                        <td>
                            <textarea name="title_album[${i}][]" class="form-control" cols="30" rows="12"></textarea>
                        </td>
                        <td>
                            <textarea name="order_number[${i}][]" class="form-control" cols="30" rows="12"></textarea>
                        </td>
                        <td align="right">
                            <button class="btn btn-danger btn-sm btn-block remove-table-row" type="button">Hapus</button>
                        </td>
                    </tr>`;
        // console.log("all-album-" + id);
        document.getElementById("all-album-" + id).insertAdjacentHTML("afterend", html);
        $('.use-dropify').dropify({
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
        // console.log("Clicked button with ID: " + id);
    };

    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    })
</script>

{{-- NAMA_ALBUM --}}
<script>
    function add_nama_album() {
        var countAlbumInput = document.getElementById("count_album");
        var a = document.getElementById("count_album");
        var Adata = parseInt(a.value)
        countAlbumInput.value = Adata + 1;
        var i = Adata + 1;
        var html = '';
        html += `<div class="card delete-data-b" >
                            <div class="card-body">
                                    <div class="container">
                                        <button class="btn btn-danger btn-right del-album-${i}" onclick="delete_album(${i})" type="button"><i class="fa fa-trash pr-2"></i>Delete</button>
                                    </div>                                    
                                    <div class="form-group">
                                <label>Nama Album</label>
                                                <input type="text" name="nama_album[${i}]" id="nama_album" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Kategori Album</label>
                                                    <select name="album_category[${i}]" id="album-category"
                                                        class="form-select @error('album_category') is-invalid @enderror">
                                                        @foreach ($album_categories as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label>Deskripsi Album</label>
                                                    <textarea name="deskripsi_album[${i}]" id="deskripsi_album" class="form-control" cols="30" rows="4"></textarea>
                                                </div>
                                            
                                                {{-- <div class="form-group">
                                                    <label>Thumbnail</label>
                                                    <input type="text" name="thumbnail" id="thumbnail" class="form-control">
                                                </div> --}}
                                            
                                                <div class="form-group">
                                                    <label>Album Galeri</label>
                                                </div>
                                                <table class="table-bordered" style="width: 100%;">
                                                    <thead>
                                                        <tr style="padding: 10px; text-align:center;">
                                                            <th style="padding: 12px">Gambar</th>
                                                            <th style="padding: 12px">Caption</th>
                                                            <th style="padding: 12px">No. Urut</th>
                                                            <th style="padding: 12px">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="all-album-${i}" style="padding:10px;">
                                                        <tr>
                                                            <td style="padding: 15px;">
                                                                <input type="file" class="use-dropify"
                                                                    name="image_album[${i}][]">
                                                            </td>
                                                            <td>
                                                                <textarea name="title_album[${i}][]" class="form-control" cols="30" rows="12"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="order_number[${i}][]" class="form-control" cols="30" rows="12"></textarea>
                                                            </td>
                                                            <td align="right">
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                </div>
                                <button type="button"
                                                                    class="btn btn-block btn-primary btn-sm btn-block mb-3"
                                                                    onclick="tambah_album(${i})">Tambah</button>
                        </div>
                        <br>`
        // html += '<p> baru</p>';
        document.getElementById("album-multiple").insertAdjacentHTML("afterend", html);
        $('.use-dropify').dropify({
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

    function delete_album(id) {
        $(`.del-album-${id}`).closest('div.delete-data-b').remove();
        var deleteCount = document.getElementById("count_album");
        var a = document.getElementById("count_album");
        var Adata = parseInt(a.value)
        // deleteCount.value = Adata - 1;
    }
    // $("#all-nama-album").on('click', `.del-album-2`, function() {
    // });


    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    })
</script>

{{-- TAMBAH FLORPLAN --}}
<script>
    function tambah_floorplan() {
        var html = '<tr>';
        html += '<td><input type="file" class="dropify" data-height="180" name="image_floorplan[]"></td>';
        html += '<td><textarea name="deskripsi_floorplan[]" class="form-control" cols="30" rows="8"></textarea></td>';
        html += '<td><button class="btn btn-danger btn-sm remove-table-row" type="button">Hapus</button></td>';
        html += '</tr>';
        document.getElementById("all-floorplan").insertAdjacentHTML("beforeend", html);
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

    $(document).on('click', '.remove-table-row', function () {
        $(this).closest('tr').remove();
    });

    function tambah_floorplan_edit() {
        var html = '<tr>';
        html += '<td><input type="file" class="dropify" data-height="180" name="new_image_floorplan[]"></td>';
        html += '<td><textarea name="new_deskripsi_floorplan[]" class="form-control" cols="30" rows="8"></textarea></td>';
        html += '<td><button class="btn btn-danger btn-sm remove-table-row" type="button">Hapus</button></td>';
        html += '</tr>';

        document.getElementById("all-floorplan").insertAdjacentHTML("beforeend", html);
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
    }

    $(document).on('click', '.remove-table-row', function () {
        $(this).closest('tr').remove();
    });
    </script>

    { { --BEDROOOMS --} }
    <script>
        var i = 0;

        function tambah_bedroom() {
            var html = '';
        html += `   <div class="card delete-data-b" >
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-danger btn-right delete-bedroom" type="button"><i class="fa fa-trash pr-2"></i>Delete</button>
                </div>
                <div class="form-group">
                    <label>Number Of Bedroom</label>
                    <input type="number" name="number_of_bedroom[]" id="number_of_bedroom"
                        class="form-control">
                </div>
            

                <div class="form-group">
                    <label>Type Of Bedroom</label>
                    <select name="type_of_bedroom[]" id="type_of_bedroom"
                        class="form-select @error('type_of_bedroom') is-invalid @enderror" required>
                        <option value="double_bed">Double Bed</option>
                        <option value="hollywood_twin">Hollywood Twin</option>
                        <option value="twin">Twin</option>
                                                    <option value="single">Single</option>
                                                    <option value="queen">Queen</option>
                                                    <option value="king">King</option>
                                                    <option value="sofa_bed">Sofa bed</option>
                                                    <option value="bunk_bed">Bunk bed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>People Can Stay Per Room</label>
                    <input type="number" name="people_can_stay_per_room[]"
                        id="people_can_stay_per_room" class="form-control">
                </div>
                <div class="form-group">
                    <label>Type Of Bathroom</label>
                    <select name="type_of_bathroom[]" id="type_of_bathroom"
                        class="form-select @error('type_of_bathroom') is-invalid @enderror" required>
                        <option value="ensuite_bathroom">Ensuite Bathroom</option>
                        <option value="guest_bathroom">Guest Bathroom</option>
                        <option value="toilet_only">Toilet Only</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
                                `
            // html += '<p> baru</p>';
            document.getElementById("bedrooms-multiple").insertAdjacentHTML("afterend", html);
        };
        $("#all-bedroom").on('click', '.delete-bedroom', function() {
            $(this).closest('div.delete-data-b').remove();
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        })
</script>
<script type="text/javascript">
            /* MPAS */
            const geojson = {
                'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
            'geometry': {
                'type': 'Point',
            'coordinates': [{{ $edit->cor_long }}, {{ $edit->cor_lat }}]
                },
            'properties': {
                'title': '{{ $edit->name }}',
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
            // console.log(url);
            $.getJSON(url, function(result) {
                $.each(result.features, function (i, features) {
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
            // console.log(result.features[0].center[0]);
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
            var cen_long = {{ $cor_long }};
            var cen_lat = {{ $cor_lat }};
            const map = new mapboxgl.Map({
                container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [cen_long, cen_lat],
            // center: [115.1163704915507, -8.334462508224263],
            zoom: 10
        });
            map.on('idle', function() {
                map.resize()
            })
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
                map.on('click', function (e) {
                    $("div").removeClass("marker");
                    var coordinates = e.lngLat;
                    // console.log(coordinates.lng);
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
        function changedateical(date) {
            $('#calendar-ical').fullCalendar('gotoDate', date);
        };
        // document.getElementById('input-copies').addEventListener('input', event =>
        //     event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
        // );
</script>

{{-- IMAGE ARRAY --}}
<script>
            var i = 0;

            function tambah_image() {
            var html = '';
            html += '<div class="col-md-3" style="margin-bottom: 10px">';
                html += '<input type="file" id="input-file-now" class="use-dropify" data-height="180" name="image[]">';
                    html +=
                    '<button class="btn btn-danger btn-sm btn-block delete-image" type="button"><i class="fa fa-trash pr-2"></i>Delete</button>';
                    html += '</div>';
            // html += '<p> baru</p>';
            document.getElementById("image-galeries").insertAdjacentHTML("afterend", html);
            $('.use-dropify').dropify({
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
            $(document).on('click', '.destroy-galeri', function() {
                let id = $(this).data('id-destroy');
            let action = $(this).data('action-destroy');
            // console.log(id);
            $.ajax({
                url: "../../edit_galeri/" + id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
                },
            success: function(data) {
                // console.log(data);
            // console.log(action);
            $('#modal-delete-image').modal('show');
            $('#deletemethod').val('DELETE');
            $('#formGaleriDestroy').attr('action', action);
                }
            });
        });
            $(document).on('click', '.edit-image', function() {
                let id = $(this).data('id-galeri');
            let action = $(this).data('action-galeri');
            // console.log(id);
            $.ajax({
                url: "../../edit_galeri/" + id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
                },
            success: function(data) {
                // console.log(data);
            var image = '../../../../uploads/' + data.galeri.image;
            // console.log(action);
            $('#modal-edit-image').modal('show');
            // $('[name="gmb_galeri"]').attr('data-default-file',image);
            $('#old-image').attr('src', image);
            $('#editmethod').val('PUT');
            $('#dropify-edit-image').dropify();
            $('#formGaleriEdit').attr('action', action);
                }
            });
        });
            $(document).on('click', '.remove-table-row', function() {
                $(this).parents('tr').remove();
        })
</script>

{{-- RATES --}}
<script>
            $(document).on('click', '.add-rates', function() {
                let action = $(this).data('action-rates');
            // console.log(action);
            $('#modal-add-rates').modal('show');
            $('#addMethodRates').val('POST');
            $('#formRatesAdd').attr('action', action);
        });

        //     $(document).on('click', '.edit-rates', function() {
        //         let id = $(this).data('id-rates');
        //     let action = $(this).data('action-rates');
        //     $.ajax({
        //         url: "../../edit_rate/" + id,
        //     type: 'GET',
        //     data: {
        //         _token: '{{ csrf_token() }}'
        //         },
        //     success: function(data) {
        //         // console.log(data.start_date);
        //     $('#nameRates').val(data.rate.name);
        //     $('#priceRates').val(data.rate.price);
        //     $('#starRates').val(data.start_date);
        //     $('#endRates').val(data.end_date);
        //     $('#typeRates option[value="' + data.rate.type + '"]').prop('selected',
        //     true);
        //     $('#modal-edit-rates').modal('show');
        //     $('#editMethodRates').val('PUT');
        //     $('#formRatesEdit').attr('action', action);
        //         }
        //     });
        // });
            $(document).on('click', '.add-ical', function() {
                let action = $(this).data('action-ical');
            // console.log(action);
            $('#modal-add-ical').modal('show');
            $('#addMethodIcal').val('POST');
            $('#formIcalAdd').attr('action', action);
        });
</script>

<script>
            //Lokasi: public/wilayah.js
            $('#negara').change(function() {

                // console.log('halo');
            var id_country = $(this).val();
            // console.log(id_country);
            if (id_country) {
                $.ajax({
                    type: "GET",
                    url: "../../subdistrict/getArea?id_country=" + id_country,
                    dataType: 'JSON',
                    success: function (res) {
                        if (res) {
                            // console.log(res);
                            $("#area").empty();
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Area not found')
                            } else {
                                $("#area").append('<option>---Insert Area---</option>');
                                $.each(res, function (name, id) {
                                    $("#area").append('<option value="' + id + '">' + name +
                                        '</option>');
                                });
                            }
                        } else {

                            // console.log('err');
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
                    url: "../../subdistrict/getLocation?id_area=" + id_area,
                    dataType: 'JSON',
                    success: function (res) {
                        if (res) {
                            // console.log(res);
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Location not found')
                                // $("#lokasi").empty();
                                // $("#area").empty();
                            } else {
                                $("#lokasi").append('<option>---Insert Location---</option>');
                                $.each(res, function (name, id) {
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
                    url: "../../subdistrict/getSubLocation?id_location=" + id_location,
                    dataType: 'JSON',
                    success: function (res) {
                        if (res) {
                            // console.log(res);
                            $("#subLokasi").empty();
                            if (res.length === 0) {
                                alert('Sub Location not found')
                            } else {
                                $("#subLokasi").append('<option>---Insert Sub Location---</option>');
                                $.each(res, function (name, id) {
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
            $('.delete-galeri').click(function(e) {
                e.preventDefault();
            let modal = $('#mod-delete-galeri');
            let image = $(this).attr('data-image');
            let link = $(this).attr('data-link');
            modal.find('#form-delete-galery').attr('action', link);
            $("#delete-image-galeri").attr("src", image);
            modal.modal();
        })

            $('.delete-floorplan').click(function(e) {
                e.preventDefault();
            let modal = $('#mod-delete-floorplan');
            let mod_deskripsi = $(this).attr('data-deskripsi');
            // console.log(mod_deskripsi);
            let link = $(this).attr('data-link');
            modal.find('#form-delete-floorplan').attr('action', link);
            document.getElementById("floorplan_deskripsi").textContent = mod_deskripsi;
            modal.modal();
        })

            $('.delete-bedroom').click(function(e) {
                e.preventDefault();
            let modal = $('#mod-delete-bedrooms');
            let link = $(this).attr('data-link');
            let bedroom = $(this).attr('data-bedroom');
            // console.log(bedroom);
            modal.find('#form-delete-bedrooms').attr('action', link);
            // $("#number_bedroom").attr("name", "bedroom");
            document.getElementById("number_bedroom").textContent = bedroom;

            modal.modal();
        })

            $('.hapus-album').click(function(e) {
                e.preventDefault();
            let modal = $('#mod-delete-album');
            let link = $(this).attr('data-link');
            let album = $(this).attr('data-value');
            // console.log(album);
            modal.find('#form-delete-album').attr('action', link);
            // $("#number_album").attr("name", "album");
            document.getElementById("nama-album").textContent = album;

            modal.modal();
        })
            $('.hapus-galeri').click(function(e) {
                e.preventDefault();
            let modal = $('#mod-delete-galeri-album');
            let link = $(this).attr('data-link');
            let title = $(this).attr('data-title');
            // console.log(title);
            modal.find('#form-delete-galeri-album').attr('action', link);
            // $("#number_galeri").attr("name", "galeri");
            document.getElementById("nama-galeri").textContent = title;

            modal.modal();
        })
</script>

{{-- ADD ROOMS JS --}}
<script>
    $(document).ready(() => {
        let edit = false;
        let rateId = null;

        fetchCurrency();

        $('#openFormRatesAdd').on('click', () => {
            emptyRatesModal();
        });

        $('#formRatesAdd').on('shown.bs.modal', () => {
            document.querySelectorAll('button[name="deleteRoomBtn"]')[0].style.display = 'none';
        });

        $('#updateRatesBtn').click(() => {
            event.preventDefault();

            storeRates({
                edit: edit,
                rateId: rateId,
            });
        });

        $(document).on('click', '.edit-rates', () => {
            const dataIdRates = event.target.getAttribute('data-id-rates');

            ajaxRequest.get({
                url: `/admin/edit_rate/${dataIdRates}`,
                successCallback: (res) => {
                    editRates(res.data);

                    edit = true;
                    rateId = dataIdRates;
                }
            });
        });
    });

    function createRoomsField() {
        const formAddRoom = document.querySelector('div[name="form-add-room"]');
        let newForm = formAddRoom.cloneNode(true);

        newForm.querySelectorAll('input').forEach(input => input.value = '');
        newForm.style.display = 'block';
        newForm.querySelector('button[name="deleteRoomBtn"]').style.display = 'block';

        document.getElementById('rooms-container').appendChild(newForm);
    }

    function deleteRoom() {
        event.target.parentElement.remove();
    }

    function fetchCurrency() {
        ajaxRequest.get({
            url: '/admin/currency/get',
            successCallback: res => {
                initOptionCurrency(res.data);
            },
        })
    }

    function initOptionCurrency(data) {
        const select = document.querySelector('select[name="currency"]');
        const option = document.createElement('option');

        option.text = 'Select Currency';
        option.value = '';
        select.appendChild(option);

        data.forEach(item => {
            const option = document.createElement('option');
            option.text = item.code;
            option.value = item.code;

            document.querySelector('select[name="currency"]').appendChild(option);
        });
    }

    function setRatesValue(dt) {
        const villaId = document.querySelector('input[name="villaId"]').value;

        const type = document.querySelector('select[name="ratesType"]').value;
        const details = document.querySelector('input[name="ratesDetails"]').value;
        const startDate = document.querySelector('input[name="start_date"]').value;
        const endDate = document.querySelector('input[name="end_date"]').value;

        const room = document.querySelectorAll('input[name="room"]');
        const currency = document.querySelectorAll('select[name="currency"]');
        const price = document.querySelectorAll('input[name="price"]');

        const rates = {
            edit: dt.edit,
            rate_id: dt.rateId,
            villa_id: villaId,
            type: type,
            details: details,
            start_date: startDate,
            end_date: endDate,
            rooms: [],
        }

        room.forEach((room, index) => {
            rates.rooms.push({
                total_bedroom: room.value,
                currency: currency[index].value,
                price: price[index].value,
            });
        });

        return rates;
    }

    function storeRates(dt) {
        const rates = setRatesValue({
            edit: dt.edit,
            rateId: dt.rateId,
        });
        const ratesJson = document.querySelector('input[name="ratesJson"]');

        ratesJson.value = JSON.stringify(rates);

        document.querySelector('form[id="formRatesAdd"]').submit();
    }

    function editRates(res) {
        $('#openFormRatesAdd').click();

        let ratesDetails = document.querySelector('input[name="ratesDetails"]');
        let ratesType = document.querySelector('select[name="ratesType"]');
        let startDate = document.querySelector('input[name="start_date"]');
        let endDate = document.querySelector('input[name="end_date"]');

        ratesDetails.value = res.details;
        ratesType.value = res.type;
        startDate.value = res.start_date;
        endDate.value = res.end_date;

        const rooms = res.rooms;

        rooms.forEach(room => {
            let roomField = document.querySelectorAll('input[name="room"]');
            let currencyField = document.querySelectorAll('select[name="currency"]');
            let priceField = document.querySelectorAll('input[name="price"]');

            roomField = roomField[roomField.length - 1];
            currencyField = currencyField[currencyField.length - 1];
            priceField = priceField[priceField.length - 1];

            roomField.value = room.total_bedroom;
            currencyField.value = room.currency;
            priceField.value = room.price;

            if(rooms.indexOf(room) !== rooms.length - 1) {
                createRoomsField();
            }
        });
    }

    function emptyRatesModal() {
        document.querySelector('input[name="ratesDetails"]').value = '';
        document.querySelector('select[name="ratesType"]').options[0].selected = true;
        document.querySelector('input[name="start_date"]').value = '';
        document.querySelector('input[name="end_date"]').value = '';

        const formAddRoom = document.querySelectorAll('div[name="form-add-room"]');
        formAddRoom.forEach((form, index) => {
            if(index !== 0) {
                form.remove();
            }
        });

        document.querySelector('input[name="room"]').value = '';
        document.querySelector('select[name="currency"]').options[0].selected = true;
        document.querySelector('input[name="price"]').value = '';
    }
</script>
{{-- CLOSE ADD ROOMS --}}
@endsection