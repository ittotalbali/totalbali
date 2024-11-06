<?php

namespace App\Http\Controllers;

use App\Models\Bathroom;
use App\Http\Requests\StoreBathroomRequest;
use App\Http\Requests\UpdateBathroomRequest;

class BathroomController extends Controller
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
     * @param  \App\Http\Requests\StoreBathroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBathroomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bathroom  $bathroom
     * @return \Illuminate\Http\Response
     */
    public function show(Bathroom $bathroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bathroom  $bathroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Bathroom $bathroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBathroomRequest  $request
     * @param  \App\Models\Bathroom  $bathroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBathroomRequest $request, Bathroom $bathroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bathroom  $bathroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bathroom $bathroom)
    {
        //
    }
}
