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
?>

<div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Datasdadsadsa</h6>
                        <a href="kurs" class="btn btn-danger">Back</a>
                    </div>
                    <div class="table-responsive">

                        

                       
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection