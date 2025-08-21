@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit Close to the clubs Villa - {{ $villa->name }}
            @else
                Add Close to the clubs Villa - {{ $villa->name }}
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.edit', ['id' => $villa->id]) }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>
 
    </div>

    <form action="{{ route('admin.villa.store_close', $villa->id) }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <span id="" class="flex-grow-1">Add Clubs</span>
                            <button id="addClubBtn" class="btn btn-primary" type="button" onclick="createClub()">Add</button>
                        </div>
                        <div id="clubsContainer">
                            <input type="hidden" name="villaId" value="{{ $villa->id }}">
                            <input type="hidden" name="clubsJson">
                            <div name="formAddClub" class="d-flex align-items-end">
                                <input type="hidden" name="clubId">

                                <div class="form-group" style="width: 30%">
                                    <label>Club Name</label>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Insert Club Name" name="clubName"
                                        value="">
                                    @error('room')
                                        <label id="room-error" class="text-danger pl-3"
                                            for="room">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group ml-1" style="width: 20%">
                                    <label>Type of Club</label>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Insert Type of Club" name="typeOfClub"
                                        value="">
                                    @error('room')
                                        <label id="room-error" class="text-danger pl-3"
                                            for="room">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group ml-1 flex-grow-1">
                                    <label>Good Days</label>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Insert Good Days" name="goodDays"
                                        value="">
                                    @error('price')
                                        <label id="price-error" class="text-danger pl-3"
                                            for="price">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group ml-1 flex-grow-1">
                                    <label>Other</label>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Insert Other" name="other"
                                        value="">
                                    @error('price')
                                        <label id="price-error" class="text-danger pl-3"
                                            for="price">{{ $message }}</label>
                                    @enderror
                                </div>

                                <button onclick="deleteClub()" name="deleteClubBtn" type="button" class="btn btn-danger border ml-1" style="height: 36px; margin-bottom: 16px">
                                    X <span class="caret"></span>
                                </button>
                            </div>
                        </div>
                        
                        
                        <button type="submit" id="submitBtn" class="btn btn-primary submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('include-css')
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

        //]]>
    </script>

    <script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(".use-dropify").dropify();
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>

    <script>
        $(document).ready(() => {
            getClub();
            
            document.querySelectorAll('button[name="deleteClubBtn"]')[0].style.display = 'none';

            $('#submitBtn').click(() => {
                setClubs();
            });
        });

        function getClub() {
            const villaId = document.querySelector('input[name="villaId"]').value;
            
            ajaxRequest.get({
                url: `/admin/villa-management/clubs/get`,
                data: {
                    id_villa: villaId
                },
                successCallback: (res) => {
                    if(res.data.length > 0) editClub(res.data);
                }
            });
        }

        function createClub() {
            const formAddRoom = document.querySelector('div[name="formAddClub"]');
            let newForm = formAddRoom.cloneNode(true);

            newForm.querySelectorAll('input').forEach(input => input.value = '');
            newForm.style.display = 'block';
            newForm.querySelector('button[name="deleteClubBtn"]').style.display = 'block';

            document.getElementById('clubsContainer').appendChild(newForm);
        }

        function editClub(res) {
            res.forEach((club) => {
                let clubIdField = document.querySelectorAll('input[name="clubId"]');
                let clubNameField = document.querySelectorAll('input[name="clubName"]');
                let typeOfClubField = document.querySelectorAll('input[name="typeOfClub"]');
                let goodDaysField = document.querySelectorAll('input[name="goodDays"]');
                let otherField = document.querySelectorAll('input[name="other"]');

                clubIdField[clubIdField.length - 1].value = club.id;
                clubNameField[clubNameField.length - 1].value = club.club_name;
                typeOfClubField[typeOfClubField.length - 1].value = club.type_of_club;
                goodDaysField[goodDaysField.length - 1].value = club.good_days;
                otherField[otherField.length - 1].value = club.other;

                if(res.indexOf(club) < res.length - 1) createClub();
            });
        }

        function deleteClub() {
            event.target.parentElement.remove();
        }

        function setClubs() {
            const clubs = [];
            const villaId = document.querySelector('input[name="villaId"]').value;

            document.querySelectorAll('div[name="formAddClub"]').forEach(form => {
                const clubId = form.querySelector('input[name="clubId"]').value;
                const clubName = form.querySelector('input[name="clubName"]').value;
                const typeOfClub = form.querySelector('input[name="typeOfClub"]').value;
                const goodDays = form.querySelector('input[name="goodDays"]').value;
                const other = form.querySelector('input[name="other"]').value;

                // if(clubName && typeOfClub && goodDays) {
                    clubs.push({
                        id_villa: villaId,
                        club_id: clubId,
                        club_name: clubName,
                        type_of_club: typeOfClub,
                        good_days: goodDays,
                        other: other
                    });
                // }
            });

            document.querySelector('input[name="clubsJson"]').value = JSON.stringify(clubs);
        }
    </script>
@endsection
