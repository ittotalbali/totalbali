@extends('admin.layouts.master')
@section('page_content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                @if (@$edit_mode)
                    Edit Area - {{ $area->name }}
                @else
                    Add Area
                @endif
            </h1>


            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.area.index') }}">
                    <button class="btn btn-outline-success">Kembali</button></a>
            </div>

        </div>

        {{-- <form action="{{ @$edit_mode ? route('admin.area.update', ['area' => $area->id]) : route('admin.area.store') }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @if (@$edit_mode)
                @method('PUT')
            @endif
            <div class="row my-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Insert your name" name="name"
                                    value="{{ @$edit_mode ? $area->name : old('name') }}">
                                @error('name')
                                    <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Countries</label>
                                <select name="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                    <option value=" "> -- Countries -- </option>
                                    @if (@$edit_mode)
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $area->country_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <a href="{{ route('admin.area.index') }}" class="btn btn-secondary submit">Batal</a>
                            <button type="submit" class="btn btn-primary submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}

        <form id="myForm">
            <!-- Your form fields here -->
            <input type="text" id="name" name="name" placeholder="name"><br><br>
            <textarea id="countrie" name="countrie" placeholder="countrie"></textarea><br><br>
        </form>

    </main>
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script>
        // Auto-save draft every 60 seconds (adjust the interval as needed)
        setInterval(function() {
            console.log('asas');
            const formData = {
                name: document.getElementById('name').value,
                countrie: document.getElementById('countrie').value,
            };

            // Store draft data in localStorage
            localStorage.setItem('draftData', JSON.stringify(formData)); 
        }, 10000); // 60 seconds
    </script>
@endsection
