<?php

namespace App\Http\Controllers;

use App\Models\Inclusions;
use App\Http\Requests\StoreInclusionsRequest;
use App\Http\Requests\UpdateInclusionsRequest;

class InclusionsController extends Controller
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
     * @param  \App\Http\Requests\StoreInclusionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInclusionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inclusions  $inclusions
     * @return \Illuminate\Http\Response
     */
    public function show(Inclusions $inclusions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inclusions  $inclusions
     * @return \Illuminate\Http\Response
     */
    public function edit(Inclusions $inclusions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInclusionsRequest  $request
     * @param  \App\Models\Inclusions  $inclusions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInclusionsRequest $request, Inclusions $inclusions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inclusions  $inclusions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inclusions $inclusions)
    {
        //
    }
}
