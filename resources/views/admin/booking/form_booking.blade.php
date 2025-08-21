@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Booking - {{ $booking->name }}
            @else
                Add Booking
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.booking.index') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form
        action="{{ @$edit_mode ? route('admin.booking.update', ['booking' => $booking->id]) : route('admin.booking.store') }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        @if (@$edit_mode)
            @method('PUT')
        @endif
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card-header">
                    <h6>Identitas</h6>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Insert your name" name="name"
                                value="{{ @$edit_mode ? $booking->name : old('name') }}">
                            @error('name')
                                <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="3"
                                placeholder="Insert your address">{{ @$edit_mode ? $booking->address : old('address') }}</textarea>
                            @error('address')
                                <label id="address-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                placeholder="Insert your email" name="email"
                                value="{{ @$edit_mode ? $booking->email : old('email') }}">
                            @error('email')
                                <label id="email-error" class="text-danger pl-3" for="email">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h6>Pilih Villa</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                    <label>Villa</label>
    <select name="villa_id" id="villa_id" class="form-control @error('villa_id') is-invalid @enderror">
        <option value=""> -- Pilih Villa -- </option>
        @foreach ($villa as $item)
           @if(isset($edit_mode) && $edit_mode)
            <option value="{{ $item->id }}" {{ $booking->villa_id == $item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
            @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endif
        @endforeach
    </select>
</div>

    
                        <div class="form-group">
                            <label>Type</label>
                            <select name="rate_type" id="type"
                                class="form-control @error('rate_type') is-invalid @enderror">
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
                                    <option value="low_season">Low season</option>
                                    <option value="high_season">High season</option>
                                    <option value="special_rate">Special rate</option>
                                    <option value="shoulder_season">Shoulder season</option>
                                    <option value="peak_season">Peak season</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" id="start-date"
                                class="form-control  @error('start_date') is-invalid @enderror"
                                placeholder="Insert your start date" name="start_date"
                                value="{{ @$edit_mode ? date('Y-m-d', strtotime($booking->start_date)) : old('start_date') }}">
                            @error('start_date')
                                <label id="start_date-error" class="text-danger pl-3"
                                    for="start_date">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" id="end-date"
                                class="form-control  @error('end_date') is-invalid @enderror"
                                placeholder="Insert your end date" name="end_date"
                                value="{{ @$edit_mode ? date('Y-m-d', strtotime($booking->end_date)) : old('end_date') }}">
                            @error('end_date')
                                <label id="end_date-error" class="text-danger pl-3" for="end_date">{{ $message }}</label>
                            @enderror
                        </div>
                        {{-- <button id="cek" class="btn btn-outline-primary btn-sm">Cek
                                Rate</button> --}}
                        <input type="button" class="btn btn-outline-primary btn-sm" id="cek" value="Cek Rate" />
                        {{-- <div id="submit-control">
                            </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Biaya</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="display_rate" style="display:none;">
                            <label>Rate</label>
                            <select name="rate_id" id="rate_id"
                                class="form-control @error('rate_id') is-invalid @enderror">
                                 <option value=" "> -- Rate -- </option>
                                 
        @foreach ($rate as $item)
            @if(@$edit_mode)
                <option value="{{ $item->id }}"{{$booking->rate_id == 'item->id' ? 'selected' : '' }}>
                {{ $item->name }}
                </option>
            @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endif
        @endforeach
    </select>
                        </div>
                        @if (@$edit_mode)
                            <p>Old Rate : {{ $booking->rate->name }}</p>
                        @endif
                        <div class="form-group" id="display_price" style="display:none;">
                            <label>Price : </label>
                            <input type="number" class="form-control  @error('rate_price') is-invalid @enderror"
                                placeholder="Insert your rate price" id="rate_price" name="rate_price"
                                value="{{ @$edit_mode ? $booking->rate_price : old('rate_price') }}" readonly>
                            @error('rate_price')
                                <label id="rate_price-error" class="text-danger pl-3"
                                    for="rate_price">{{ $message }}</label>
                            @enderror
                        </div>
                        @if (@$edit_mode)
                            <p>Old Price : {{ $booking->rate_price }}</p>
                        @endif
                        <div class="form-group" id="display_total" style="display:none;">
                            <label>Total</label>
                            <input type="number" class="form-control  @error('rate_total') is-invalid @enderror"
                                placeholder="Insert your rate total" id="rate_total" name="rate_total"
                                value="{{ @$edit_mode ? $booking->rate_total : old('rate_total') }}" readonly>
                            @error('rate_total')
                                <label id="rate_total-error" class="text-danger pl-3"
                                    for="rate_total">{{ $message }}</label>
                            @enderror
                        </div>
                        @if (@$edit_mode)
                            <p>Old Total Price : {{ $booking->total_price }}</p>
                        @endif
                        <div id="display_btn" style="display:none;">
                            <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    {{-- <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control" id="start-date" required />
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" class="form-control" id="end-date" required />
                </div>
                <button id="submit">Submit</button>
            </div>
        </div> --}}
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    @if (@$edit_mode)
        <script type="text/javascript">
            var base_url = "{{ url('') }}";
            $('#cek').on('click', function() {

                var villa = $('#villa_id').val(); 
                var type = $('#type').val();

                 console.log(villa, type);
                var start_date = new Date($('#start-date').val());
                var dS = start_date.getDate();
                var mS = ("0" + (start_date.getMonth() + 1)).slice(-2);
                var yS = start_date.getFullYear();
                var dS = [yS, mS, dS].join('-')

                var end_date = new Date($('#end-date').val());
                var dE = end_date.getDate();
                var mE = ("0" + (end_date.getMonth() + 1)).slice(-2);
                var yE = end_date.getFullYear();
                var dE = [yE, mE, dE].join('-')
                $.ajax({
                    url: "../../get_date",
                    type: "GET",
                    data: {
                        villa: villa,
                        type: type,
                        start_date: dS,
                        end_date: dE,
                    },
                    success: function(res) {
                        if (res) {
                            $("#rate_id").empty();
                            $("#display_rate").show();
                            $("#display_total").show();
                            $("#display_price").show();
                            $("#display_btn").show();
                            $("#rate_id").append('<option>---Pilih Rate---</option>');
                            console.log(res.rate);
                            $.each(res.rate, function(id, name) {
                                $("#rate_id").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                        } else {
                            $("#rate_id").empty();
                        }
                    },
                    error: function(x, e) {
                        if (x.status == 500) {
                            alert('Form villa is not complete');
                        }
                    }
                });
                return false;
            });
            $('#rate_id').on('change', function(e) {
                var rate = e.target.value;
                var start_date = new Date($('#start-date').val());
                var dS = start_date.getDate();
                var mS = ("0" + (start_date.getMonth() + 1)).slice(-2);
                var yS = start_date.getFullYear();
                var dS = [yS, mS, dS].join('-')

                var end_date = new Date($('#end-date').val());
                var dE = end_date.getDate();
                var mE = ("0" + (end_date.getMonth() + 1)).slice(-2);
                var yE = end_date.getFullYear();
                var dE = [yE, mE, dE].join('-')
                console.log(rate);
                //ajax

                $.ajax({
                    url: "../../get_price",
                    type: "GET",
                    data: {
                        id: rate,
                        start_date: dS,
                        end_date: dE,
                    },
                    success: function(res) {
                        var rate_price = res.rate.price;
                        var rate_total = res.harga;
                        // console.log(harga);
                        $("#rate_price").val(rate_price);
                        $("#rate_total").val(rate_total);
                    },
                    error: function(request, status, error) {
                        console.log(error);
                    }
                })
            });
        </script>
    @else
        <script type="text/javascript">
            var base_url = "{{ url('') }}";
            $('#cek').on('click', function() {

                var villa = $('#villa_id').val(); 
                var type = $('#type').val();

                // console.log('Selected Villa:', villa);
                // console.log('Selected Type:', type);
                var start_date = new Date($('#start-date').val());
                var dS = start_date.getDate();
                var mS = ("0" + (start_date.getMonth() + 1)).slice(-2);
                var yS = start_date.getFullYear();
                var dS = [yS, mS, dS].join('-')

                var end_date = new Date($('#end-date').val());
                var dE = end_date.getDate();
                var mE = ("0" + (end_date.getMonth() + 1)).slice(-2);
                var yE = end_date.getFullYear();
                var dE = [yE, mE, dE].join('-')
                // console.log('Selected start date:', start_date);
                // console.log('Selected end date', dE);
                $.ajax({
                    url: "../get_date",
                    type: "GET",
                    data: {
                        villa: villa,
                        type: type,
                    },
                    success: function(res) {
                        if (res) {
                            $("#rate_id").empty();
                            $("#display_rate").show();
                            $("#display_total").show();
                            $("#display_price").show();
                            $("#display_btn").show();
                            $("#rate_id").append('<option>---Pilih Rate---</option>');
                            console.log('Selected res:', res);
                            $.each(res.rate, function(id, name) {
                                $("#rate_id").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                            
                        } else {
                            $("#rate_id").empty();
                        }
                    },
                    error: function(x, e) {
                        if (x.status == 500) {
                            alert('Form villa is not complete');
                        }
                    }
                });
                return false;
            });

            $('#rate_id').on('change', function(e) {
                var rate = e.target.value;
                var start_date = new Date($('#start-date').val());
                var dS = start_date.getDate();
                var mS = ("0" + (start_date.getMonth() + 1)).slice(-2);
                var yS = start_date.getFullYear();
                var dS = [yS, mS, dS].join('-')

                var end_date = new Date($('#end-date').val());
                var dE = end_date.getDate();
                var mE = ("0" + (end_date.getMonth() + 1)).slice(-2);
                var yE = end_date.getFullYear();
                var dE = [yE, mE, dE].join('-')
                console.log('Selected rate:', rate);

                var rate_total = $('#rate_total').val(); 
                var rate_price = $('#rate_price').val();
                            //ajax

                $.ajax({
                    url: "../get_price",
                    type: "GET",
                    data: {
                        id: rate,
                        start_date: dS,
                        end_date: dE,
                    },
                    success: function(res) {
                        var rate_price = res.rate.price;
                        var rate_total = res.harga;
                         //console.log(harga);
                        $("#rate_price").val(rate_price);
                        $("#rate_total").val(rate_total);
                    },
                    error: function(request, status, error) {
                        console.log(error);
                    }
                })
            });
        </script>
    @endif
@endsection
