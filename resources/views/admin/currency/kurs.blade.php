@extends('admin.layouts.master')

@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Currencies</h1>
    </div>

    @include('admin.layouts.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
<?php
$hal = isset($_GET["hal"]) ? $_GET["hal"] : ""; 
$id = isset($_GET["id"]) ? $_GET["id"] : ""; 
$name = isset($_GET["name"]) ? $_GET["name"] : ""; 
if ($hal == "aksi") { 
?>

<div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Currency Conversion From <b>{{$name}}</b></h6>
                        <a href="kurs" class="btn btn-danger">Back</a>
                    </div>
                    <div class="table-responsive">
<table class="table currency-table">
                        <thead>
                            <tr>
                                <th>to Currency</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($currencies as $item)
                        @if ($item->id != $id)
                            <tr>
                                <td class="currency-name">{{ $item->name }} ({{ $item->code }})</td>
                                <td class="currency-value">
                                    @php
                                        $found = false;
                                    @endphp
                                    @foreach ($konversi as $konx)
                                        @if ($konx->from_curs_id == $id && $konx->to_curs_id == $item->id)
                                        
                                        <?php
                                        $nilai = $konx->value;
                                        // Cek apakah nilai memiliki bagian desimal
                                        if (strpos($nilai, '.') !== false) {
                                            // Menggunakan number_format untuk menghapus angka nol di belakang koma
                                            $nilai = rtrim(rtrim($nilai, '0'), '.');
                                        }
                                        ?>
                                        <form class="currency-form-put">
                            <div class="input-group">
                            <input type="hidden" class="form-control" name="idput" value="{{$konx->id}}">
                                <input type="hidden" class="form-control" name="from" value="{{$id}}">
                                <input type="hidden" class="form-control" name="to" value="{{$item->id}}">
                                <input type="number" class="form-control" name="itemvalue" value="{{$nilai}}" style="text-align:right;">
                                <button type="button" class="btn btn-xs btn-primary convert-btn-put">Save</button>
                            </div>
                        </form>
                                        @php $found = true; @endphp
                                        @break
                                        @endif
                                    @endforeach

                                    @if (!$found)
                                    <form class="currency-form-post">
                        <div class="input-group">
                            <input type="hidden" class="form-control" name="from" value="{{$id}}">
                            <input type="hidden" class="form-control" name="to" value="{{$item->id}}">
                            <input type="number" class="form-control" name="itemvalue" value="" style="text-align:right;">
                            <button type="button" class="btn btn-xs btn-primary convert-btn-post">Save</button>
                        </div>
                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @endforeach

                        </tbody>
                    </table>
                        
<?php } else { ?>

    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Currency Conversion</h6>
                    </div>
                    <div class="table-responsive">
    <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($currencies as $item)
                                    @if ($item->id == 7 )
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><a href="kurs?hal=aksi&id={{$item->id}}&name={{$item->name}}" class="btn btn-sm btn-outline-success edit-btn" >Detail</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                @foreach ($currencies as $item)
                                    @if ($item->id != 7 )
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><a href="kurs?hal=aksi&id={{$item->id}}&name={{$item->name}}" class="btn btn-sm btn-outline-success edit-btn" >Detail</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
<?php } ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('include-css')
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
$(document).ready(function () {
    // Ketika tombol Save (POST) diklik
    $('.convert-btn-post').click(function () {
        var form = $(this).closest('form');  // Ambil form yang terkait
        var fromCursId = form.find('input[name="from"]').val();
        var toCursId = form.find('input[name="to"]').val();
        var value = form.find('input[name="itemvalue"]').val();

        if (fromCursId && toCursId && value) {
            var data = {
                from_curs_id: fromCursId,
                to_curs_id: toCursId,
                value: value
            };

            var apiKey = '5c3c28eb9ffed1087400d2f4274731a2';
            var apiUrl = 'https://api-total-villa-mock.creaf.tech/api/v1/currency-exchanges';


            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                headers: {
                    'Authorization': 'Bearer ' + apiKey,
                    'x-pt-key': apiKey
                },
                success: function(response) {
                    alert('Conversion saved successfully!');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                    console.log(xhr.responseText);
                }
            });
        } else {
            alert('Please fill in all fields.');
        }
    });

    // Ketika tombol Save (PUT) diklik
    $('.convert-btn-put').click(function () {
    var form = $(this).closest('form');  // Ambil form yang terkait
    var fromCursId = form.find('input[name="from"]').val();
    var toCursId = form.find('input[name="to"]').val();
    var value = form.find('input[name="itemvalue"]').val();
    var idput = form.find('input[name="idput"]').val();  // Ambil nilai ID dari input "idput"

    if (fromCursId && toCursId && value && idput) {  // Pastikan ID dan data lainnya ada
        var data = {
            from_curs_id: fromCursId,
            to_curs_id: toCursId,
            value: value
        };

        var apiKey = '5c3c28eb9ffed1087400d2f4274731a2';
        var apiUrl = 'https://api-total-villa-mock.creaf.tech/api/v1/currency-exchanges/' + idput; // Menambahkan ID ke URL

        $.ajax({
            url: apiUrl,
            type: 'PUT',
            data: JSON.stringify(data),
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + apiKey,
                'x-pt-key': apiKey
            },
            success: function(response) {
                alert('Conversion updated successfully!');
                console.log(response);
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
                console.log(xhr.responseText);
            }
        });
    } else {
        alert('Please fill in all fields.');
    }
});

});

</script>

@endsection