<?php

namespace App\Http\Controllers;

use App\Models\MountainVilla;
use App\Http\Requests\StoreMountainVillaRequest;
use App\Http\Requests\UpdateMountainVillaRequest;

class MountainVillaController extends Controller
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
     * @param  \App\Http\Requests\StoreMountainVillaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMountainVillaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MountainVilla  $mountainVilla
     * @return \Illuminate\Http\Response
     */
    public function show(MountainVilla $mountainVilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MountainVilla  $mountainVilla
     * @return \Illuminate\Http\Response
     */
    public function edit(MountainVilla $mountainVilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMountainVillaRequest  $request
     * @param  \App\Models\MountainVilla  $mountainVilla
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMountainVillaRequest $request, MountainVilla $mountainVilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MountainVilla  $mountainVilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(MountainVilla $mountainVilla)
    {
        //
    }
}
