@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h4">Villa Database</h1>
        </div>

        <form action="{{ route('admin.villa.search') }}" enctype="multipart/form-data" method="GET"> 
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="database-admin.html" method="post">
                                <div class="form-row">
                                    {{-- <div class="form-group col-md-3" hidden>
                                        <label>Countries</label>
                                        <select name="country" id="negara" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group col-md-4">
                                        <label>Area</label>
                                        <select name="area_id" id="area" class="form-control">
                                            <option value=""> -- Select All -- </option>
                                            @foreach ($areas as $item)
                                                <option value="{{ $item->id }}" {{($request->area_id == $item->id)?'selected':''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Location</label>
                                        <select name="location_id" id="lokasi" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            @foreach ($location as $item)
                                                <option value="{{ $item->id }}" {{($request->location_id == $item->id)?'selected':''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sub Location</label>
                                        <select name="sub_location_id" id="subLokasi" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            @foreach ($sublocation as $item)
                                                <option value="{{ $item->id }}" {{($request->sub_location_id == $item->id)?'selected':''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                        <label>I Cal avaialblity </label>
                                        <select name="country" id="negara" class="form-control ">
                                            <option value=" "> -- pilih -- </option>
                                            <option value="1">Yes
                                            </option>
                                            <option value="2">No
                                            </option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group col-md-3">
                                        <label>Start date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="" value="{{($request->has('start_date'))?$request->start_date:''}}">
                                        @error('start_date')
                                            <label id="start_date-error" class="text-danger pl-3" for="start_date">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>End date</label>
                                        <input type="date" class="form-control  @error('end_date') is-invalid @enderror" name="end_date" id=""  value="{{($request->has('end_date'))?$request->end_date:''}}">
                                        @error('end_date')
                                            <label id="end_date-error" class="text-danger pl-3" for="end_date">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Bedroom</label>
                                        <select name="bedroom" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            @for ($i = 1; $i < 8; $i++)
                                            <option value="{{ $i }}" {{ ($request->bedroom == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                            <option value="8" {{ ($request->bedroom == 8) ? 'selected' : '' }}>7+</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                        <label>Bathroom</label>
                                        <select name="bathroom" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">5+</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Monthly Rental</label>
                                        <select name="monthly" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Yearly Rental</label>
                                        <select name="yearly" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Freehold</label>
                                        <select name="freehold" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Leasehold</label>
                                        <select name="leasehold" class="form-control ">
                                            <option value=""> -- Select All -- </option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <span class="text-danger">* Wajib diisi</span>
                                    </div> --}}
                                </div>
                                    
                                <button type="submit" class="btn btn-primary submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama villa</th>
                                <th>Code villa</th>
                                <th>Location</th>
                                <th>Sub location</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th>Base rate</th>
                                <th>Monthly</th>
                                <th>Yearly</th>
                                <th>Sales</th>
                                <th>Maps</th>
                                <th>Airbnb</th>
                                <th>Booking.com</th>
                                <th>Old link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach ($villas as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><a href="{{ $item->new_link }}" class="redirect-url">{{ $item->name }}</a></td>
                                    @if (isset($item->code))
                                    <td><a href="https://totalbali.com/detail-villa?id={{ $item->id }}" class="redirect-url">{{ $item->code }}</a></td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                  
                                    <td>{{ $item->location->name ?? 'N/A' }}</td>
                                    <td>{{ $item->sublocation->name ?? 'N/A' }}</td> 
                                    <td>{{ $item->bedroom }}</td>
                                    <td>{{ $item->bathroom }}</td>
                                    <td>{{ $item->base_rate_currency . ' ' . number_format($item->base_rate) }}</td>
                                    <td class="text-wrap">{{ $item->pricing->monthly_description ?? 'N/A' }}</td>
                                    <td class="text-wrap">{{ $item->pricing->yearly_description ?? 'N/A' }}</td>
                                    <td class="text-wrap">{{ $item->pricing->available_for_sales_description ?? 'N/A' }}</td>
                                    <td><a href="{{ $item->link_map }}" class="redirect-url"><i data-feather="map-pin"></i></a></td>
                                    <td><a href="{{ $item->airbnb_link }}" class="redirect-url"><i class="bg-danger text-white" data-feather="link"></i></a></td>
                                    <td><a href="{{ $item->bookingcom_link }}" class="redirect-url"><i class="bg-primary text-white" data-feather="link"></i></a></td>
                                    <td><a href="{{ $item->old_link }}" class="redirect-url"><i class="bg-secondary text-white" data-feather="link"></i></a></td>
                                    <td>
                                        @can('detail-search')
                                        <a href="{{ route('admin.villa.detail',  $item->id) }}">
                                            <button class="btn btn-sm btn-primary">Detail</button>
                                        </a>
                                        @endcan
                                        <a href="{{ route('admin.villa.edit', ['id' => $item->id]) }}">
                                            <button class="btn btn-sm btn-outline-success">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        

    </main>
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script>
        $('#area').change(function() {
            var id_area = $(this).val();
            if (id_area) {
                $.ajax({
                    type: "GET",
                    url: "./subdistrict/getLocation?id_area=" + id_area,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#lokasi").empty();
                            $("#subLokasi").empty();
                            $("#lokasi").append('<option value="">--- Select All---</option>');
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
                    url: "./subdistrict/getSubLocation?id_location=" + id_location,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            console.log(res);
                            $("#subLokasi").empty();
                            $("#subLokasi").append('<option value="">--- Select All ---</option>');
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

        $(document).ready(function() {
            const redirectUrl = document.querySelectorAll('.redirect-url');

            redirectUrl.forEach(url => {
                url.addEventListener('click', e => {
                    e.preventDefault();

                    let href = e.target.href;
                    if(href == undefined || href == '') {
                        href = e.target.parentElement.href;
                    }

                    if(href != undefined && href != '') {
                        window.open(href, '_blank');
                    }
                });
            });
        });
    </script>
@endsection
