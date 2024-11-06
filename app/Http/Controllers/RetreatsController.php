<?php

namespace App\Http\Controllers;

use App\Models\Retreats;
use App\Http\Requests\StoreRetreatsRequest;
use App\Http\Requests\UpdateRetreatsRequest;

class RetreatsController extends Controller
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
     * @param  \App\Http\Requests\StoreRetreatsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRetreatsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retreats  $retreats
     * @return \Illuminate\Http\Response
     */
    public function show(Retreats $retreats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retreats  $retreats
     * @return \Illuminate\Http\Response
     */
    public function edit(Retreats $retreats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRetreatsRequest  $request
     * @param  \App\Models\Retreats  $retreats
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRetreatsRequest $request, Retreats $retreats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retreats  $retreats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retreats $retreats)
    {
        //
    }
}
