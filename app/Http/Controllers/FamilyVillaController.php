<?php

namespace App\Http\Controllers;

use App\Models\FamilyVilla;
use App\Http\Requests\StoreFamilyVillaRequest;
use App\Http\Requests\UpdateFamilyVillaRequest;

class FamilyVillaController extends Controller
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
     * @param  \App\Http\Requests\StoreFamilyVillaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyVillaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyVilla  $familyVilla
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyVilla $familyVilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyVilla  $familyVilla
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyVilla $familyVilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFamilyVillaRequest  $request
     * @param  \App\Models\FamilyVilla  $familyVilla
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyVillaRequest $request, FamilyVilla $familyVilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyVilla  $familyVilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyVilla $familyVilla)
    {
        //
    }
}
