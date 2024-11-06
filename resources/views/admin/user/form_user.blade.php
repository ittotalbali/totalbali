@extends('admin.layouts.master')
@section('page_content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (@$edit_mode)
                Edit User - {{ $user->name }}
            @else
                Add User
            @endif
        </h1>


        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.user.index') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>

    </div>

    <form action="{{ @$edit_mode ? route('admin.user.update', ['user' => $user->id]) : route('admin.user.store') }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        @if (@$edit_mode)
            @method('PUT')
        @endif
        <div class="row my-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Insert your name" name="name"
                                value="{{ @$edit_mode ? $user->name : old('name') }}">
                            @error('name')
                                <label id="name-error" class="text-danger pl-3" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control  @error('no_hp') is-invalid @enderror"
                                placeholder="Insert your no_hp" name="no_hp"
                                value="{{ @$edit_mode ? $user->no_hp : old('no_hp') }}">
                            @error('no_hp')
                                <label id="no_hp-error" class="text-danger pl-3" for="no_hp">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" id="input-file-now" class="use-dropify" name="image"
                                data-default-file="{{ @$edit_mode ? asset('uploads/' . $user->image) : '' }}">
                            @error('image')
                                <label id="image-error" class="text-danger pl-3" for="image">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Insert your email" name="email"
                                value="{{ @$edit_mode ? $user->email : old('email') }}">
                            @error('email')
                                <label id="email-error" class="text-danger pl-3" for="email">{{ $message }}</label>
                            @enderror
                        </div>
                        @if (@$edit_password)
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Insert your password" name="password"
                                    value="{{ @$edit_mode ? $user->password : old('password') }}">
                                @error('password')
                                    <label id="password-error" class="text-danger pl-3"
                                        for="password">{{ $message }}</label>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group danger">
                            <label>Roles</label>
                            <div class="form-group">
                                @foreach ($roles as $item)
                                    <div class="form-check">
                                        <label class="form-check-label radio-btn">
                                            @if (@$edit_mode)
                                                <input type="radio" class="form-check-input" name="role"
                                                    id="{{ $item->id }}" value="{{ ucfirst($item->name) }}"
                                                    {{ $item->name == $user->role ? 'checked' : '' }}>
                                                {{ ucfirst($item->name) }}
                                                <i class="input-frame"></i>
                                            @else
                                                <input type="radio" class="form-check-input" name="role"
                                                    id="{{ $item->id }}" value="{{ ucfirst($item->name) }}">
                                                {{ ucfirst($item->name) }}
                                                <i class="input-frame"></i>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            </select>
                            @error('role')
                                <label id="role-error" class="text-danger pl-3" for="role">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if (@$edit_mode)
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Form Edit Password</h1>
        </div>

        <form action="{{ route('admin.user.update-password', $user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="row my-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control  @error('new_password') is-invalid @enderror"
                                    placeholder="Insert your New Password" name="new_password">
                                @error('new_password')
                                    <label id="new_password-error" class="text-danger pl-3"
                                        for="new_password">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirmation Password</label>
                                <input type="password"
                                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Repeat your password confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                    <label id="password_confirmation-error" class="text-danger pl-3"
                                        for="password_confirmation">{{ $message }}</label>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
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
    <script src="{{ asset('admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(".use-dropify").dropify();
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>
@endsection
