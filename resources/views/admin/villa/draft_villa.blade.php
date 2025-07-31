@extends('admin.layouts.master')
@section('page_content')
<div class="container">
    <div class="card">
        <form action="{{ route('admin.villa.post_draft_villa') }}" enctype="multipart/form-data" method="POST">
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
                        {{-- <li>Retreats</li>
                            <li>Wedding Villa</li>
                            <li>Mountain Villa</li>
                            <li>Close To The Clubs</li>
                            <li>Family Villa</li>
                            <li>Beach Villa</li> --}}
                    </ul>
                </div>
                <div class="right-side">

                    <div class="main active">
                        <div class="form-group">
                            <label>Name Villa</label>
                            <input type="text" name="name" id="villa-name" class="form-control" onkeyup="gen_villa_code()">
                        </div>
                        <div class="text">
                            <h2>Which of these best describes your place?</h2>
                            {{-- <p>Which of these best describes your place?</p> --}}
                        </div>
                        <div class="input-text">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input typeAccomodation" type="radio"
                                            name="type_accomodation" id="house" value="house">
                                        <label class="form-check-label" for="house">
                                            House
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input typeAccomodation" type="radio"
                                            name="type_accomodation" id="villa" value="villa">
                                        <label class="form-check-label" for="villa">
                                            Villa
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input typeAccomodation" type="radio"
                                            name="type_accomodation" id="guesthouse" value="guesthouse">
                                        <label class="form-check-label" for="guesthouse">
                                            Guesthouse
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input typeAccomodation" type="radio"
                                            name="type_accomodation" id="apartment" value="apartment">
                                        <label class="form-check-label" for="apartment">
                                            Apartment
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input typeAccomodation" type="radio"
                                            name="type_accomodation" id="hotel" value="hotel">
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

                    {{-- Privacy Type --}}
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
                                        value="{{ @$edit_mode ? $villa->cor_lat : old('cor_lat') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control  @error('cor_long') is-invalid @enderror"
                                        placeholder="Longtitude" name="cor_long" id="cor_long"
                                        value="{{ @$edit_mode ? $villa->cor_long : old('cor_long') }}">
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Countries</label>
                                    <select name="country_id" id="negara"
                                        class="form-select @error('area_id') is-invalid @enderror">
                                        <option value=" "> -- Country -- </option>
                                        @foreach ($country as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Area</label>
                                    <select name="area_id" id="area" onchange="gen_villa_code()"
                                        class="form-select @error('area_id') is-invalid @enderror">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="location_id" id="lokasi" onchange="gen_villa_code()"
                                        class="form-select @error('location_id') is-invalid @enderror">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Location</label>
                                    <select name="sub_location_id" id="subLokasi" onchange="gen_villa_code()"
                                        class="form-select @error('sub_location_id') is-invalid @enderror">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Link Maps</label>
                                    <input type="text" name="link_map" class="form-control">
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
                                    <input type="number" class="form-control" id="guest" name="guest">
                                </div>
                                <hr>
                                <div class="col-md-8">
                                    <h3>Total Bedrooms</h3>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" id="bedroom-qty" name="bedroom" onchange="gen_villa_code()">
                                </div>
                                <hr>
                                <div class="col-md-8">
                                    <h3>Total Bed</h3>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" id="bed" name="bed">
                                </div>
                                <hr>
                                <div class="col-md-8">
                                    <h3>Total Bathroom</h3>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" id="bathroom" name="bathroom">
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
                                                id="{{ $item->id }}">
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
                                        @foreach ($faciliti as $item)
                                        <div class="tile">
                                            <input type="checkbox" name="faciliti[]" value="{{ $item->id }}"
                                                id="{{ $item->id }}">
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
                                        <label>Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Staff</label>
                                        <input type="text" name="staff" id="staff" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Land size</label>
                                        <input type="text" name="landsize" id="landsize" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Building size</label>
                                        <input type="text" name="buildingsize" id="buildingsize"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Year Built</label>
                                        <input type="number" name="yearbuilt" id="yearbuilt" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Renovation</label>
                                        <input type="text" name="last_renovation" id="last_renovation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Are pets allowed</label>
                                        <select name="pets" id="pets"
                                            class="form-select @error('pets') is-invalid @enderror">
                                            <option value="">-- Choose Are Pets Allowed --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Wheelchair friendly</label>
                                        <select name="wheelchair_friendly" id="wheelchair_friendly"
                                            class="form-select @error('wheelchair_friendly') is-invalid @enderror">
                                            <option value="">-- Choose Are Wheelchair friendly --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Internet Information</label>
                                        <input type="text" name="internet" id="internet" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Villa BVP</label>
                                        <select name="villa_bvp" id="villa_bvp"
                                            class="form-select @error('villa_bvp') is-invalid @enderror">
                                            <option value="">-- Choose Villa BVP --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
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
                            {{-- <div class="form-group">
                                    <label>Villa Code</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon3">https://totalbali.com/</span>
                                        </div>
                                        <input type="text" name="code" class="form-control" id="villa-code" aria-describedby="basic-addon3" readonly>
                                      </div>
                                </div> --}}

                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short" id="short" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Long Description</label>
                                <textarea name="long" id="editor" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Old Link</label>
                                <input type="text" name="old_link" id="oldLink" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="new_link" id="newLink" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Airbnb Link</label>
                                <input type="text" name="airbnb_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Booking.com Link</label>
                                <input type="text" name="bookingcom_link" class="form-control">
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
                                <option value="{{ $currency->code }}">
                                    {{ $currency->code }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-4">
                            <div class="form-group">
                                <input type="number" name="base_rate" id="baseRate" class="form-control">
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
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
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
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
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
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
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

                                <div class="form-group">
                                    <label>Pool</label>
                                    <select name="pool" id="pool"
                                        class="form-select @error('pool') is-invalid @enderror">
                                        <option value="">-- Choouse Pool --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" id="type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="private">Private</option>
                                        <option value="shared">Shared</option>
                                        <option value="no_pool">No Pool</option>
                                        <option value="sauna">Sauna</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Size Of Pool</label>
                                    <textarea name="size_of_pool" id="size_of_pool" class="form-control" cols="30" rows="4"></textarea>
                                </div>

                                <div class="container">
                                    <section class="title-bedroom">
                                        Additional guest</section>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Max Guests</label>
                                            <input type="number" name="max_guests" id="max_guests"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Charge per Extra Guest </label>
                                            <textarea name="extra_guest_charge" id="extra_guest_charge" class="form-control" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div id="all-bedroom">
                                    <div class="container">
                                        <section class="title-bedroom">
                                            Bedroom</section>
                                        <button type="button" name="add_image" onclick="tambah_bedroom()"
                                            class="btn-right btn btn-success">Add Bedrooms</button>
                                    </div>
                                    {{-- <br> <br>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Number Of Bedroom</label>
                                                    <input type="number" name="number_of_bedroom[]"
                                                        id="number_of_bedroom" class="form-control">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Type Of Bedroom</label>
                                                    <select name="type_of_bedroom[]" id="type_of_bedroom"
                                                        class="form-select @error('type_of_bedroom') is-invalid @enderror"
                                                        required>
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
                                                        class="form-select @error('type_of_bathroom') is-invalid @enderror"
                                                        required>
                                                        <option value="ensuite_bathroom">Ensuite Bathroom</option>
                                                        <option value="guest_bathroom">Guest Bathroom</option>
                                                        <option value="toilet_only">Toilet Only</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br> --}}

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
                                    <textarea name="breakfast_description" id="breakfast_description" class="form-control" cols="30"
                                        rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Airport Transfer</label>
                                    <select name="airport" id="airport"
                                        class="form-select @error('airport') is-invalid @enderror">
                                        <option value="">-- Choose Airport --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Airport Description</label>
                                    <textarea name="airport_description" id="airport_description" class="form-control" cols="30" rows="4"></textarea>
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
                                    <label>Massage Description</label>
                                    <textarea name="pijet_description" id="pijet_description" class="form-control" cols="30" rows="4"></textarea>
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
                                    <textarea name="anything_else_description" id="anything_else_description" class="form-control" cols="30"
                                        rows="4"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button type="button" class="back_button">Back</button>
                            <button type="button" class="next_button">Next Step</button>
                            <button type="submit" class="btn btn-info">Save Draft</button>
                        </div>
                    </div>

                    {{-- Retreats --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Retreats ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Workout Deck</label>
                                        <input type="text" name="workout_deck" id="workout_deck"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Exlusive Rental</label>
                                        <input type="text" name="exlusive_rental" id="exlusive_rental"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>House Chef</label>
                                        <input type="text" name="house_chef" id="house_chef" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Views From Workout</label>
                                        <input type="text" name="views_from_workout" id="views_from_workout"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Gym</label>
                                        <input type="text" name="gym" id="gym" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Wedding Villa --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Wedding Villa ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Standing Guest</label>
                                        <input type="text" name="standing_guests" id="standing_guests"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Seated Guest</label>
                                        <input type="text" name="seated_guests" id="seated_guests"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Additional Function Fee</label>
                                        <input type="number" name="addtional_function_fee" id="addtional_function_fee"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Banjar Fee</label>
                                        <input type="number" name="banjar_fee" id="banjar_fee" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Security Deposit</label>
                                        <input type="text" name="security_deposit" id="security_deposit"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Music Curfew</label>
                                        <textarea name="music_curfew" id="music_curfew" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Other Information</label>
                                        <textarea name="other_informasion" id="other_informasion" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Weeding Packgaes</label>
                                        <select name="wedding_packages" class="form-select">
                                            <option value="">-- Choose Wedding Packgaes --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Wedding Packgaes Information</label>
                                        <textarea name="wedding_packages_information" id="wedding_packages_information" class="form-control" cols="30"
                                            rows="4"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Wedding Villa --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Montain Villa ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Montain View</label>
                                        <textarea name="mountain_view" id="mountain_view" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>View Of Recifield</label>
                                        <textarea name="view_of_ricefield" id="view_of_ricefield" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Rover Closeby</label>
                                        <textarea name="river_closeby" id="river_closeby" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Waterfall Closeby</label>
                                        <textarea name="waterfall_closeby" id="waterfall_closeby" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Activities</label>
                                        <textarea name="activities" id="activities" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Track Information</label>
                                        <textarea name="track_information" id="track_information" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Birdwatching</label>
                                        <textarea name="birdwatching" id="birdwatching" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Guide</label>
                                        <textarea name="guide" id="guide" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Close To The Clubs --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Close To The Clubs ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Club Name</label>
                                        <textarea name="club_name" id="club_name" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Type Of Club</label>
                                        <textarea name="type_of_club" id="type_of_club" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Good Days</label>
                                        <textarea name="good_days" id="good_days" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Family Villa --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Family Villa ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Pool Fence</label>
                                        <textarea name="pool_fence" id="pool_fence" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Baby Cot</label>
                                        <textarea name="baby_cot" id="baby_cot" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Infant Cot</label>
                                        <textarea name="infant_cot" id="infant_cot" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Baby High Chair</label>
                                        <textarea name="baby_high_chair" id="baby_high_chair" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Chef</label>
                                        <select name="chef_family_villa" id="chef_family_villa"
                                            class="form-select @error('chef') is-invalid @enderror">
                                            <option value="">-- Choose Chef --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Costs For Chef</label>
                                        <input type="number" name="costs_for_chef" id="costs_for_chef"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Nanny Cost</label>
                                        <input type="text" name="nanny_cost" id="nanny_cost" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Included / Cost per day</label>
                                        <input type="text" name="included" id="included" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="text" name="photos" id="photos" class="form-control">
                                        <input type="file" id="input-file-now" class="use-dropify" name="photos">
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Beach Villa --}}
                    {{-- <div class="main">
                            <div class="text">
                                <h2>Beach Villa ?</h2>
                            </div>
                            <div class="input-text">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>What Beach</label>
                                        <textarea name="what_beach" id="what_beach" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>How Far Walking</label>
                                        <textarea name="how_far_walking" id="how_far_walking" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Views Of Ocean</label>
                                        <textarea name="views_of_ocean" id="views_of_ocean" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Surf Villa</label>
                                        <select name="surf_villa" id="surf_villa"
                                            class="form-select @error('surf_villa') is-invalid @enderror" required>
                                            <option value="yes">-- Choose Surf Villa --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Waves Nearby</label>
                                        <textarea name="waves_nearby" id="waves_nearby" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Extra Information</label>
                                        <textarea name="extra_information" id="extra_information" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Other Information</label>
                                        <textarea name="other_information" id="other_information" class="form-control" cols="30" rows="4"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button type="button" class="back_button">Back</button>
                                <button type="button" class="next_button">Next Step</button>
                                <button type="submit" class="btn btn-info">Save Draft</button>
                            </div>
                        </div> --}}

                    {{-- Beach Villa --}}
                    <div class="main">
                        <div class="text">
                            <h2>Staff At Villa ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>House Keeper</label>
                                    <input type="number" name="house_keeper" id="house_keeper"
                                        class="form-control">
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
                            <h2>Chef/Cook ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Chef/Cook</label>
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
                                    <textarea name="information" id="information" class="form-control" cols="30" rows="4"></textarea>
                                </div>

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

                                <div class="form-group">
                                    <label>System For Use</label>
                                    <input type="text" name="system_for_use" id="system_for_use"
                                        class="form-control">
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
                                    <textarea name="information_car" id="information_car" class="form-control" cols="30" rows="4"></textarea>
                                </div>

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
                                <div id="all-nama-album">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Kategori Album</label>
                                                <select name="album_category[]" id="album-category"
                                                    class="form-select @error('album_category') is-invalid @enderror">
                                                    @foreach ($album_categories as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Album</label>
                                                <select name="nama_album[]" id="nama_album" class="form-control">
                                                    <option value="other">Other</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}">Bedroom {{ $i }}</option>
                                                        @endfor
                                                </select>
                                                <!--<input type="text" name="nama_album[]" id="nama_album"-->
                                                <!--    class="form-control">-->
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
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm btn-block mb-3"
                                                                onclick="tambah_album(0)">Tambah</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <!-- <div class="form-group">
                                                    <label>Album Galeri</label>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div id="all-album-0">
                                                                <div class="row" id="table">
                                                                    <div class="col-md-3" style="margin-bottom: 10px">
                                                                        <input type="file" id="input-file-now"
                                                                            class="use-dropify" name="image_album[]"
                                                                            data-default-file="{{ @$edit_mode ? asset('uploads/' . $faciliti->image) : '' }}">
                                                                    </div>
                                                                    <div id="view-image-album-0"></div>
                                                                </div>
                                                                <div class="row">
                                                                    <button type="button" name="add_album"
                                                                        onclick="tambah_album(0)"
                                                                        class="btn btn-success btn-block"
                                                                        style="margin-top: 10px; margin-bottom:10px;">Tambah</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  -->
                                        </div>
                                    </div>
                                    <br>
                                    <div id="album-multiple"></div>
                                </div>
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

                                <div class="form-group">
                                    <label>Name Floorplan</label>
                                    <input type="text" name="nama_floorplan" id="nama_floorplan"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Floorplan</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="4"></textarea>
                                </div>

                                <div class="container">
                                    <section class="title-bedroom">Gambar Floorplan</section>
                                </div> <br>

                                {{-- <table class="table table-bordered">
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
                                                    <input type="file" id="input-file-now" class="use-dropify"
                                                        name="image_floorplan[]">
                                                </td>
                                                <td>
                                                    <textarea name="deskripsi_floorplan[]" class="form-control" id="" cols="30" rows="8"></textarea>
                                                </td>
                                                <td align="right">
                                                    <button type="button" class="btn btn-primary btn-sm btn-block mb-3"
                                                        onclick="tambah_floorplan()">Tambah</button>
                                                </td>
                                            </tr>
                                            <tr id="view-image-floorplan"></tr>
                                        </tbody>
                                    </table> --}}

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
                                                <input type="file" class="use-dropify"
                                                    name="image_floorplan[]">
                                            </td>
                                            <td>
                                                <textarea name="deskripsi_floorplan[]" class="form-control" cols="30" rows="8"></textarea>
                                            </td>
                                            <td align="right">
                                                <button type="button" class="btn btn-primary btn-sm mb-3"
                                                    onclick="tambah_floorplan()">Tambah</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button type="button" class="back_button">Back</button>
                            <button type="button" class="next_button">Next Step</button>
                            <button type="submit" class="btn btn-info">Save Draft</button>
                        </div>
                    </div>

                    {{-- Wedding Villa --}}
                    <div class="main">
                        <div class="text">
                            <h2>Monthly Rental ?</h2>
                        </div>
                        <div class="input-text">
                            <div class="col-md-12">

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
                                    <textarea name="monthly_description" id="monthly_description" class="form-control" cols="30"
                                        rows="4"></textarea>
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
                                    <textarea name="yearly_description" id="yearly_description" class="form-control" cols="30"
                                        rows="4"></textarea>
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
                                    <textarea name="available_for_sales_description" id="available_for_sales_description" class="form-control"
                                        cols="30" rows="4"></textarea>
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
                                    <textarea name="long_term_rental" id="long_term_rental" class="form-control" cols="30"
                                        rows="4"></textarea>
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
                                    <textarea name="freehold_description" id="freehold_description" class="form-control" cols="30"
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
                                    <textarea name="leasehold_description" id="leasehold_description" class="form-control" cols="30"
                                        rows="4"></textarea>
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
        background-image: url('{{ asset(' icon/marker.png') }}');
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

    function next_jump(e) {
        formnumber = e;
        updateform();
        progress_forward_side();
        // progress_backward_side();
        contentchange();

    }


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

    // var heart = document.querySelector(".fa-heart");
    // heart.addEventListener('click', function() {
    //     heart.classList.toggle('heart');
    // });


    // var share = document.querySelector(".fa-share-alt");
    // share.addEventListener('click', function() {
    //     share.classList.toggle('share');
    // });



    function updateform() {
        main_form.forEach(function(mainform_number) {
            mainform_number.classList.remove('active');
        })
        main_form[formnumber].classList.add('active');
    }

    function progress_forward() {
        num.innerHTML = formnumber + 1;
        step_list[formnumber].classList.add('active');
    }

    function progress_forward_side() {
        [].forEach.call(step_list, function(el) {
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
        // var code = area.toLowerCase()+'/'+lokasi.toLowerCase()+'/'+sublokasi.toLowerCase()+'/'+bedroom+'-bedroom/'+convertToSlug(name);
        // console.log(code);
        // $('#villa-code').val(code);
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

{{-- ALBUMS --}}
<script>
    function tambah_album(id) {
        var i = id;
        // console.log(i);
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
        // html += '<div class="col-md-3" style="margin-bottom: 10px">';
        // html += '  <input type="file" class="dropify" data-height="180"  name="image_album[]">';
        // html += '  <button class="btn btn-danger btn-sm btn-block delete-album" type="button">Hapus</button>';
        // html += '</div>';
        // html += '<p> baru</p>';
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
        // console.log("Clicked button with ID: " + id); // You can use the ID here as needed
        var countGaleriInput = document.getElementById("c_album_galeri");
        countGaleriInput.value = i + 1;
    };
    // $("#all-album-" + id).on('click', '.delete-album' + id, function() {
    //     $(this).closest('div').remove();
    // });

    $(document).on('click', '.remove-table-row', function() {
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
                                <label>Nama Album</label>
                                  <select name="nama_album[${i}]" id="nama_album" class="form-control">
                                                               <option value="other" {{ $item->nama == 'other' ? 'selected' : '' }}>Other</option>
                                                               @for ($i = 1; $i <= 20; $i++)
                                                                    <option value="{{ $i }}" {{ $item->nama == (string)$i ? 'selected' : '' }}>Bedroom {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                // <input type="text" name="nama_album[${i}]" id="nama_album" class="form-control">
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
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm btn-block mb-3"
                                                                    onclick="tambah_album(${i})">Tambah</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                </div>
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


    $(document).on('click', '.remove-table-row', function() {
        $(this).parents('tr').remove();
    })
</script>

{{-- FLOORPLAN --}}
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

    $(document).on('click', '.remove-table-row', function() {
        $(this).closest('tr').remove();
    });
</script>

{{-- BEDROOOMS --}}
<script>
    var i = 0;

    function tambah_bedroom() {
        var html = '';
        html += `<div class="card delete-data-b" >
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
                        <br>`
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


<script>
    //Lokasi: public/wilayah.js
    $('#negara').change(function() {

        // console.log('halo');
        var id_country = $(this).val();
        // console.log(id_country);
        if (id_country) {
            $.ajax({
                type: "GET",
                url: "/admin/subdistrict/getArea?id_country=" + id_country,
                dataType: 'JSON',
                success: function(res) {
                    if (res) {
                        // console.log(res);
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
                url: "/admin/subdistrict/getLocation?id_area=" + id_area,
                dataType: 'JSON',
                success: function(res) {
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
                url: "/admin/subdistrict/getSubLocation?id_location=" + id_location,
                dataType: 'JSON',
                success: function(res) {
                    if (res) {
                        // console.log(res);
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
        // console.log(url);
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
            // console.log(coordinates);
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

{{-- <script>
        $(document).ready(function() {
            var _autosave;
            // $('#save').on('click', function() {
            //     clearInterval(_autosave);
            //     var _token = $("input[name='_token']").val();
            //     var name = $('.nameBooking').val();
            //     // var name = $('.nameBooking').val();
            //     var address = $('.addressBooking').val();
            //     var email = $('.emailBooking').val();
            //     var booking_id = $('#booking_id').val();
            //     if (name != "" && address != "") {
            //         $.ajax({
            //             url: '{{ route('admin.booking.post_draft') }}',
// type: 'POST',
// data: {
// _token: _token,
// name: name,
// address: address,
// email: email,
// booking_id: booking_id
// },
// success: function() {
// window.location.href = '{{ route('admin.booking.index') }}';
// AutoSave();
// }
// });
// }
// });

function AutoSave() {
_autosave = setInterval(function() {

var pool = document.getElementById('pool').value;
var type = document.getElementById('type').value;
var size_of_pool = $('#size_of_pool').val();
var pool_id = $('#pool_id').val();

var _token = $("input[name='_token']").val();
var type_accomodation = $('input[name="type_accomodation"]:checked').val();
console.log(type_accomodation);
var privacy_type = $('input[name="privacy_type"]:checked').val();
var cor_lat = $('#cor_lat').val();
var cor_long = $('#cor_long').val();
var country_id = document.getElementById('negara').value;
var area_id = document.getElementById('lokasi').value;
var location_id = document.getElementById('lokasi').value;
var sub_location_id = document.getElementById('subLokasi').value;
var address = $('#address').val();
var link_map = $('#linkMaps').val();
var guest = $('#guest').val();
var bedroom = $('#bedroom').val();
var bed = $('#bed').val();
var bathroom = $('#bathroom').val();
var pets = document.getElementById('pets').value;
var staff = $('#staff').val();
var landsize = $('#landsize').val();
var buildingsize = $('#buildingsize').val();
var yearbuilt = $('#yearbuilt').val();
var internet = $('#internet').val();
var code = $('#code').val();
var title = $('#title').val();
var short = $('#short').val();
var long = $('#longDesc').val();
var old_link = $('#oldLink').val();
var new_link = $('#newLink').val();
var base_rate = $('#baseRate').val();
var camera = document.getElementById('camera').value;
var weapon = document.getElementById('weapon').value;
var animal = document.getElementById('animal').value;
var villa_id = $('#villa_id').val();
if (type_accomodation != "") {
$.ajax({
type: 'POST',
url: '{{ route('admin.villa.update_draft_villa') }}',
data: {
_token: _token,
type_accomodation: type_accomodation,
privacy_type: privacy_type,
cor_lat: cor_lat,
cor_long: cor_long,
country_id: country_id,
area_id: area_id,
location_id: location_id,
sub_location_id: sub_location_id,
address: address,
link_map: link_map,
guest: guest,
bedroom: bedroom,
bed: bed,
bathroom: bathroom,
pets: pets,
staff: staff,
landsize: landsize,
buildingsize: buildingsize,
yearbuilt: yearbuilt,
internet: internet,
code: code,
title: title,
short: short,
long: long,
old_link: old_link,
new_link: new_link,
base_rate: base_rate,
camera: camera,
weapon: weapon,
animal: animal,
villa_id: villa_id
},
dataType: 'json',
success: function(data) {
console.log(data);
if (data != "") {
$('#villa_id').val(data);
$('#succesDraft').text("Post save as draft");
setInterval(function() {
$('#succesDraft').text("");
}, 5000);
}
}
});
}

if (pool != "") {
$.ajax({
type: 'POST',
url: '{{ route('admin.villa.update_draft_pool') }}',
data: {
_token: _token,
pool: pool,
type: type,
size_of_pool: size_of_pool,
villa_id: villa_id,
pool_id: pool_id
},
dataType: 'json',
success: function(data) {
console.log(data);
if (data != "") {
$('#pool_id').val(data);
}
}
});
}
},

1000);
}
AutoSave();

});
</script> --}}
@endsection