@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Edit Villa - {{ $edit->title }}
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.villa.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        @include('admin.layouts.alert')
        <div class="container">
            <div class="card">
                <form action="{{ route('admin.villa.update', ['villa' => $edit->id]) }}" enctype="multipart/form-data"
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
                                {{-- <p class="step-number-content active">Enter your personal information to get closer to companies.</p>
                            <p class="step-number-content d-none">Get to know better by adding your diploma,certificate and education life.</p>
                            <p class="step-number-content d-none">Help companies get to know you better by telling then about your past experiences.</p>
                            <p class="step-number-content d-none">Add your profile piccture and let companies find youy fast.</p> --}}
                            </div>
                            <ul class="progress-bar-wizard">
                                <li class="active">Type Accomodation</li>
                                <li>Privacy Type</li>
                                <li>Location</li>
                                <li>Floor Plan</li>
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
                                                    id="house" value="house"
                                                    {{ $edit->type_accomodation == 'house' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="house">
                                                    House
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type_accomodation"
                                                    id="guesthouse" value="guesthouse"
                                                    {{ $edit->type_accomodation == 'guesthouse' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="guesthouse">
                                                    Guesthouse
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type_accomodation"
                                                    id="apartment" value="apartment"
                                                    {{ $edit->type_accomodation == 'apartment' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="apartment">
                                                    Apartment
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type_accomodation"
                                                    id="hotel" value="hotel"
                                                    {{ $edit->type_accomodation == 'hotel' ? 'checked' : '' }}>
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
                                                    id="entireplace" value="entireplace"
                                                    {{ $edit->privacy_type == 'entireplace' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="entireplace">
                                                    An entire place
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="privacy_type"
                                                    id="room" value="room"
                                                    {{ $edit->privacy_type == 'room' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="room">
                                                    A Room
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="privacy_type"
                                                    id="sharedroom" value="sharedroom"
                                                    {{ $edit->privacy_type == 'sharedroom' ? 'checked' : '' }}>
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
                                            <input type="text"
                                                class="form-control  @error('cor_lat') is-invalid @enderror"
                                                placeholder="Latitude" name="cor_lat" id="cor_lat"
                                                value="{{ $edit->cor_lat }}" readonly required require>
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control  @error('cor_long') is-invalid @enderror"
                                                placeholder="Longtitude" name="cor_long" id="cor_long"
                                                value="{{ $edit->cor_long }}" readonly required require>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Countries</label>
                                            <select name="country_id" id="negara"
                                                class="form-select @error('area_id') is-invalid @enderror" required
                                                require>
                                                <option value=" "> -- Country -- </option>
                                                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $edit->country_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select name="area_id" id="area"
                                                class="form-select @error('area_id') is-invalid @enderror">
                                                @foreach ($area as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $edit->area_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select name="location_id" id="lokasi"
                                                class="form-select @error('location_id') is-invalid @enderror">
                                                @foreach ($lokasi as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $edit->location_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Location</label>
                                            <select name="sub_location_id" id="subLokasi"
                                                class="form-select @error('sub_location_id') is-invalid @enderror">
                                                @foreach ($sublokasi as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $edit->sub_location_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" id="" cols="30" rows="10" require>{{ $edit->address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Link Maps</label>
                                            <input type="text" name="link_map" class="form-control"
                                                value="{{ $edit->link_map }}" require>
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
                                            <input type="number" class="form-control" name="guest"
                                                value="{{ $edit->guest }}" required require>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <h3>Bedrooms</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="bedroom"
                                                value="{{ $edit->bedroom }}" required require>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <h3>Bed</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="bed"
                                                value="{{ $edit->bed }}" required require>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <h3>Bathroom</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="bathroom"
                                                value="{{ $edit->bathroom }}" required require>
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
                                                @foreach ($faciliti as $key => $item)
                                                    <div class="tile">
                                                        <input type="checkbox" name="faciliti[]"
                                                            value="{{ $item->id }}" id="{{ $item->id }}"
                                                            {{ $item->villa != null ? 'checked' : '' }}>
                                                        <label class="label-kategori" for="{{ $item->id }}">
                                                            {{-- <i class="fas fa-quidditch"></i> --}}
                                                            <img src="{{ asset('uploads/' . $item->image) }}"
                                                                alt="" class="fas img-fluid" width="150px">
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
                                                <input type="text" name="staff" class="form-control"
                                                    value="{{ $edit->staff }}" require>
                                            </div>
                                            <div class="form-group">
                                                <label>Land size</label>
                                                <input type="text" name="landsize" class="form-control"
                                                    value="{{ $edit->landsize }}" require>
                                            </div>
                                            <div class="form-group">
                                                <label>Building size</label>
                                                <input type="text" name="buildingsize" class="form-control"
                                                    value="{{ $edit->buildingsize }}" require>
                                            </div>
                                            <div class="form-group">
                                                <label>Year Built</label>
                                                <input type="text" name="yearbuilt" class="form-control"
                                                    value="{{ $edit->yearbuilt }}" require>
                                            </div>
                                            <div class="form-group">
                                                <label>Are pets allowed</label>
                                                <select name="pets" id="pets"
                                                    class="form-select @error('pets') is-invalid @enderror" required
                                                    require>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Internet Information</label>
                                                <input type="text" name="internet" class="form-control"
                                                    value="{{ $edit->internet }}" require>
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
                                        <input type="text" name="code" class="form-control"
                                            value="{{ $edit->code }}" require>
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $edit->title }}" require>
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short" class="form-control" id="" cols="30" rows="5" require>{{ $edit->short }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea name="long" class="form-control" id="" cols="30" rows="10" require>{{ $edit->long }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Old Link</label>
                                        <input type="text" name="old_link" class="form-control"
                                            value="{{ $edit->old_link }}" require>
                                    </div>
                                    <div class="form-group">
                                        <label>New Link</label>
                                        <input type="text" name="new_link" class="form-control"
                                            value="{{ $edit->new_link }}" require>
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
                                        <input type="number" name="base_rate" class="form-control"
                                            value="{{ $edit->base_rate }}" require>
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
                                                <option value="yes" {{ $edit->camera == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no" {{ $edit->camera == 'no' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <h3>Weapons</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="weapon" id="weapon"
                                                class="form-select @error('weapon') is-invalid @enderror" required require>
                                                <option value="yes" {{ $edit->weapon == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no" {{ $edit->weapon == 'yes' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="col-md-8">
                                            <h3>Dangerous Animal</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="animal" id="animal"
                                                class="form-select @error('animal') is-invalid @enderror" required require>
                                                <option value="yes" {{ $edit->animal == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no" {{ $edit->animal == 'no' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="buttons button_space">
                                    <button type="button" class="back_button">Back</button>
                                    <button type="submit" class="submit_button">Update</button>
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

        {{-- RATES --}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Rates</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('permission-create')
                    {{-- <a href="{{ route('admin.villa.create_rate', $edit->id) }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a> --}}
                    <button type="button" class="btn btn-primary add-rates" data-target="#formRatesAdd"
                        data-action-rates="{{ route('admin.villa.store_rate', $edit->id) }}"
                        data-toggle="modal">Tambah</button>
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
                                                                {{-- <a href="{{ route('admin.villa.edit_rate', $item->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-success">Edit
                                                                    </button>
                                                                </a> --}}
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-success edit-rates"
                                                                    data-target="#formRatesEdit"
                                                                    data-id-rates="{{ $item->id }}"
                                                                    data-action-rates="{{ route('admin.villa.update_rate', $item->id) }}"
                                                                    data-toggle="modal">Edit</button>
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
                                                                            Delete
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

        {{-- TAMBAH RATES --}}
        <form method="POST" action="" class="card-body" id="formRatesAdd" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="modal-add-rates" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
                aria-hidden="true">
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
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    placeholder="Insert your name" name="name"
                                                    value="{{ @$edit_mode ? $rate->name : old('name') }}" required>
                                                @error('name')
                                                    <label id="name-error" class="text-danger pl-3"
                                                        for="name">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number"
                                                    class="form-control  @error('price') is-invalid @enderror"
                                                    placeholder="Insert your price" name="price"
                                                    value="{{ @$edit_mode ? $rate->price : old('price') }}" required>
                                                @error('price')
                                                    <label id="price-error" class="text-danger pl-3"
                                                        for="price">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type"
                                                    class="form-control @error('type') is-invalid @enderror" required>
                                                    @if (@$edit_mode)
                                                        <option
                                                            value="low"{{ $rate->type == 'low' ? 'selected' : '' }}>Low
                                                        <option
                                                            value="base"{{ $rate->type == 'base' ? 'selected' : '' }}>
                                                            Base
                                                        <option
                                                            value="high"{{ $rate->type == 'high' ? 'selected' : '' }}>
                                                            High
                                                        <option
                                                            value="peak"{{ $rate->type == 'peak' ? 'selected' : '' }}>
                                                            Peak
                                                        @else
                                                        <option value="low">Low
                                                        <option value="base">Base
                                                        <option value="high">High
                                                        <option value="peak">Peak
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
                                                <label>Start Date</label>
                                                <input type="date"
                                                    class="form-control  @error('start_date') is-invalid @enderror"
                                                    placeholder="Insert your start date" name="start_date"
                                                    value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->start_date)) : old('start_date') }}"
                                                    required>
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
                                                    value="{{ @$edit_mode ? date('Y-m-d', strtotime($rate->end_date)) : old('end_date') }}"
                                                    required>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- EDIT RATES --}}
        <form method="POST" action="" class="card-body" id="formRatesEdit" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal fade" id="modal-edit-rates" tabindex="-1" role="dialog"
                aria-labelledby="modalEditTitle" aria-hidden="true">
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
                                                <input type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    placeholder="Insert your name" name="name" id="nameRates"
                                                    value="{{ @$edit_mode ? $rate->name : old('name') }}" required>
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
                                                    value="{{ @$edit_mode ? $rate->price : old('price') }}" required>
                                                @error('price')
                                                    <label id="price-error" class="text-danger pl-3"
                                                        for="price">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type"
                                                    class="form-control @error('type') is-invalid @enderror"
                                                    id="typeRates" required>
                                                    @if (@$edit_mode)
                                                        <option
                                                            value="low"{{ $rate->type == 'low' ? 'selected' : '' }}>Low
                                                        <option
                                                            value="base"{{ $rate->type == 'base' ? 'selected' : '' }}>
                                                            Base
                                                        <option
                                                            value="high"{{ $rate->type == 'high' ? 'selected' : '' }}>
                                                            High
                                                        <option
                                                            value="peak"{{ $rate->type == 'peak' ? 'selected' : '' }}>
                                                            Peak
                                                        @else
                                                        <option value="low">Low
                                                        <option value="base">Base
                                                        <option value="high">High
                                                        <option value="peak">Peak
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
                                                <input type="date" class="form-control" id="starRates"
                                                    name="start_date" placeholder="" required>
                                                @error('start_date')
                                                    <label id="start_date-error" class="text-danger pl-3"
                                                        for="start_date">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" id="endRates"
                                                    name="end_date" placeholder="" required>
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
        </form>
        <input type="text" id="id_villa" value="{{ $edit->id }}" hidden>



    </main>
@endsection
@section('include-css')
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
    <link href='{{ asset('admin/plugins/fullcalendar/fullcalendar.css') }}' rel='stylesheet' />
    <link href='{{ asset('admin/plugins/fullcalendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
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
    </style>
@endsection
@section('include-js')
    <script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(".use-dropify").dropify();
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>
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
        var cen_long = {{ $edit->cor_long }};
        var cen_lat = {{ $edit->cor_lat }};
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [cen_long, cen_lat],
            zoom: 15
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
            console.log(id);
            $.ajax({
                url: "../../edit_galeri/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    console.log(action);
                    $('#modal-delete-image').modal('show');
                    $('#deletemethod').val('DELETE');
                    $('#formGaleriDestroy').attr('action', action);
                }
            });
        });
        $(document).on('click', '.edit-image', function() {
            let id = $(this).data('id-galeri');
            let action = $(this).data('action-galeri');
            console.log(id);
            $.ajax({
                url: "../../edit_galeri/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    var image = '../../../../uploads/' + data.galeri.image;
                    console.log(action);
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

        $(document).on('click', '.edit-rates', function() {
            let id = $(this).data('id-rates');
            let action = $(this).data('action-rates');
            $.ajax({
                url: "../../edit_rate/" + id,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data.start_date);
                    $('#nameRates').val(data.rate.name);
                    $('#priceRates').val(data.rate.price);
                    $('#starRates').val(data.start_date);
                    $('#endRates').val(data.end_date);
                    $('#typeRates option[value="' + data.rate.type + '"]').prop('selected',
                        true);
                    $('#modal-edit-rates').modal('show');
                    $('#editMethodRates').val('PUT');
                    $('#formRatesEdit').attr('action', action);
                }
            });
        });
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
                    url: "../../sub_location/getArea?id_country=" + id_country,
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
                    url: "../../sub_location/getLocation?id_area=" + id_area,
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
                    url: "../../sub_location/getSubLocation?id_location=" + id_location,
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
        $('.delete-galeri').click(function(e) {
            e.preventDefault();
            let modal = $('#mod-delete-galeri');
            let image = $(this).attr('data-image');
            let link = $(this).attr('data-link');
            modal.find('#form-delete-galery').attr('action', link);
            $("#delete-image-galeri").attr("src", image);
            modal.modal();
        })
    </script>
@endsection
