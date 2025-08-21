<?php

namespace App\Http\Controllers;

use App\Models\Floorplan;
use App\Http\Requests\StoreFloorplanRequest;
use App\Http\Requests\UpdateFloorplanRequest;

class FloorplanController extends Controller
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
     * @param  \App\Http\Requests\StoreFloorplanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFloorplanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Floorplan  $floorplan
     * @return \Illuminate\Http\Response
     */
    public function show(Floorplan $floorplan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Floorplan  $floorplan
     * @return \Illuminate\Http\Response
     */
    public function edit(Floorplan $floorplan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFloorplanRequest  $request
     * @param  \App\Models\Floorplan  $floorplan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFloorplanRequest $request, Floorplan $floorplan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Floorplan  $floorplan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floorplan $floorplan)
    {
        //
    }
}
