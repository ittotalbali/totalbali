@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Villa</h1>
    </div>

    @include('admin.layouts.alert')

    <!-- Include Select2 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
    

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Generate Rate</h6>
                    </div>

                    <div class="row">
                        <div class="col-md-2 grid-margin stretch-card">
                            Select Villa
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <select id="villaSelect" class="form-control">
                                @foreach ($villa as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 grid-margin stretch-card">
                            <button id="kirimButton" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>

                    <!-- Bagian ini disembunyikan secara default -->
                    <div id="rateSection" class="table-responsive" style="display:none;">
                        <textarea id="iframeText" rows="2" class="form-control" style="text-align:center; display: flex; justify-content: center; align-items: center;" readonly></textarea>
                        <button id="copyButton" class="btn btn-sm btn-secondary mt-2" style="align:right;">Copy</button>
                        <iframe id="rateIframe" src="" width="100%" height="700" frameborder="0"></iframe>                        
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('include-js')
    <!-- Include jQuery (required for Select2) -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->    
    <!-- Include Select2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi Select2 pada dropdown
            // $('#villaSelect').select2({
            //     placeholder: 'Pilih Villa',  // Placeholder
            //     allowClear: true,            // Tombol clear
            //     width: '100%'                // Lebar dropdown
            // });

            // Menunggu event klik pada tombol kirim
            $('#kirimButton').click(function() {
                // Ambil nilai yang dipilih dari dropdown
                var villaId = $('#villaSelect').val();

                // Buat URL iframe baru dengan id yang dipilih
                var iframeUrl = 'https://totalbali.com/villa/rates.php?id=' + villaId;

                // Tampilkan bagian yang disembunyikan
                $('#rateSection').show();

                // Ubah src dari iframe
                $('#rateIframe').attr('src', iframeUrl);

                // Ubah nilai textarea
                $('#iframeText').val('<iframe src="' + iframeUrl + '" width="100%" height="700" frameborder="0"></iframe>');
            });

            // Fungsi untuk menyalin teks dari textarea
            $('#copyButton').click(function() {
                var textarea = $('#iframeText');
                textarea.select();
                document.execCommand('copy'); // Menyalin ke clipboard
                alert('Teks telah disalin ke clipboard!');
            });
        });
    </script>
@endsection