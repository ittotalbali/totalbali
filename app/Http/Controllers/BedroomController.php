<?php

namespace App\Http\Controllers;

use App\Models\bedroom;
use App\Http\Requests\StorebedroomRequest;
use App\Http\Requests\UpdatebedroomRequest;

class BedroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebedroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebedroomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bedroom  $bedroom
     * @return \Illuminate\Http\Response
     */
    public function show(bedroom $bedroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bedroom  $bedroom
     * @return \Illuminate\Http\Response
     */
    public function edit(bedroom $bedroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebedroomRequest  $request
     * @param  \App\Models\bedroom  $bedroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebedroomRequest $request, bedroom $bedroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bedroom  $bedroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(bedroom $bedroom)
    {
        //
    }
}
