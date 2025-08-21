@extends('admin.layouts.master')
@section('page_content')
    <form enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card-header">
                    <h6>Identitas</h6>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control nameBooking @error('name') is-invalid @enderror"
                                placeholder="Insert your name" name="name" id=""
                                value="{{ @$edit_mode ? $booking->name : old('name') }}">
                            @error('name')
                                <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <input type="text" id="booking_id" />
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" id="" class="form-control addressBooking @error('address') is-invalid @enderror" cols="30"
                                rows="3" placeholder="Insert your address">{{ @$edit_mode ? $booking->address : old('address') }}</textarea>
                            @error('address')
                                <label id="address-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email as</label>
                            <input type="email" id=""
                                class="form-control emailBooking @error('email') is-invalid @enderror" placeholder="Insert your email"
                                name="email" value="{{ @$edit_mode ? $booking->email : old('email') }}">
                            @error('email')
                                <label id="email-error" class="text-danger pl-3" for="email">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary submit">Batal</a>
            <button type="submit" id="save" class="btn btn-primary submit">Simpan</button>
        </div>
    </form>

    <div id="succesDraft"></div>
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script>
        $(document).ready(function() {
            var _autosave;
            $('#save').on('click', function() {
                clearInterval(_autosave);
                var _token = $("input[name='_token']").val();
                var name = $('.nameBooking').val();
                // console.log(name);
                // var name = $('.nameBooking').val();
                var address = $('.addressBooking').val();
                var email = $('.emailBooking').val();
                var booking_id = $('#booking_id').val();
                if (name != "" && address != "") {
                    $.ajax({
                        url: '{{ route('admin.booking.post_draft') }}',
                        type: 'POST',
                        data: {
                            _token: _token,
                            name: name,
                            address: address,
                            email: email,
                            booking_id: booking_id
                        },
                        success: function() {
                            window.location.href = '{{ route('admin.booking.index') }}';
                            AutoSave();
                        }
                    });
                }
            });

            function AutoSave() {
                _autosave = setInterval(function() {
                    var _token = $("input[name='_token']").val();
                    var name = $('.nameBooking').val();
                    console.log(name);
                    var address = $('.addressBooking').val();
                    var email = $('.emailBooking').val();
                    var booking_id = $('#booking_id').val();
                    if (name != "" && address != "") {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.booking.update_draft') }}',
                            data: {
                                _token: _token,
                                name: name,
                                address: address,
                                email: email,
                                booking_id: booking_id
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                if (data != "") {
                                    $('#booking_id').val(data);
                                    $('#succesDraft').text("Post save as draft");
                                    console.log('syceessss');
                                    setInterval(function() {
                                        $('#succesDraft').text("");
                                    }, 5000);
                                }
                            }
                        });
                    }
                }, 2000);
            }
            AutoSave();

        });
    </script>
@endsection
