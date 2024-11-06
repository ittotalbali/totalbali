<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Countries;
use App\Models\Location;
use App\Models\SubLocation;
use Illuminate\Http\Request;
use Hash;
use Storage;
use Validator;
use File;

class SubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:area-list|area-create|area-edit|area-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:area-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:area-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:area-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
        $sub = SubLocation::with('location')->get();
        $location = Location::all();
        // dd($sub);
        $data["page_title"] = 'Manajemen Sub Locations';
        $data['sub'] = $sub;
        $data['location'] = $location;
        return view('admin.sub_location.index', $data);
    }

    public function lokasi()
    {
        //
        $country = Countries::all();
        $data['country'] = $country;
        $data["page_title"] = 'Manajemen Sub Lokasi';
        return view('admin.sub_location.lokasi', $data);
    }
    public function wizard()
    {
        //
        $country = Countries::all();
        $data['country'] = $country;
        $data["page_title"] = 'Manajemen Wizard';
        return view('admin.sub_location.wizard', $data);
    }

    public function getArea(Request $request)
    {
        $data = Areas::where("country_id", $request->id_country)->pluck('id', 'name');
        return response()->json($data);
    }
    public function getLocation(Request $request)
    {
        $data = Location::where("area_id", $request->id_area)->pluck('id', 'name');
        return response()->json($data);
    }
    public function getSubLocation(Request $request)
    {
        // $data = Location::where("area_id", $request->id_area)->pluck('id', 'name');
        $data = SubLocation::where("location_id", $request->id_location)->pluck('id', 'name');
        // dd($data);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sub = SubLocation::all();
        $data["page_title"] = 'Tambah Sub Locations';
        $data['edit_password'] = true;
        $data['sub'] = $sub;
        return view('admin.sub_location.form_sub', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        // dd($request->all());
        $rules = array(
            'name' => 'required',
            'location_id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $object = [
            'name' => $request->name,
            'location_id' => $request->location_id,
        ];
        // dd($object);

        SubLocation::create($object);
        return redirect()->route('admin.sub_location.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function show(SubLocation $subLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sub = SubLocation::find($id);
        // dd($sub->toArray());
        $location = Location::all();
        // $data['edit_mode'] = true;
        $data['sub'] = $sub;
        $data['location'] = $location;
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            'location_id' => 'required',
        );
        // dd($rules);
        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = array(
            'name' => $request->name,
            'location_id' => $request->location_id,
        );

        $current = SubLocation::findOrFail($id);
        $current->update($object);

        return redirect()->route('admin.sub_location.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sub = SubLocation::where('id', $id)->firstOrFail();
        $sub->delete();
        return redirect()->route('admin.sub_location.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
