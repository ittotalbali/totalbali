<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Location;
use App\Models\SubLocation;
use App\Models\Villas;
use Illuminate\Http\Request;
use Hash;
use Storage;
use Validator;
use File;

class LocationController extends Controller
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
        $location = Location::all();
        $area = Areas::all();
        // dd($area->toArray());
        $data["page_title"] = 'Manajemen Locations';
        $data['location'] = $location;
        $data['area'] = $area;
        return view('admin.location.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $area = Areas::all();
        $data["page_title"] = 'Tambah Locations';
        $data['edit_password'] = true;
        $data['area'] = $area;
        return view('admin.location.form_location', $data);
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
        $rules = array(
            'name' => 'required',
            'area_id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $object = array(
            'name' => $request->name,
            'area_id' => $request->area_id,
        );

        Location::create($object);
        return redirect()->route('admin.location.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $location = Location::find($id);
        $area = Areas::all();
        $data['page_title'] = 'Update Locations';
        $data['edit_mode'] = true;
        $data['location'] = $location;
        $data['area'] = $area;
        return response()->json($data);
    }

    public function cek_data(Location $location, $id)
    {
        //
        $location = Location::find($id);

        $cekSubLocation = SubLocation::where('location_id', $id)->get();
        $cekVilla = Villas::where('location_id', $id)->get();

        // dd(empty($cekVilla->toArray()));
        // dd($countries->toArray());
        if (empty($cekVilla->toArray()) == false) {
            $villa = '<li>Villa</li>';
        } else {
            $villa = '';
        }
        $data['page_title'] = 'Cek DAta';
        $data['validasi'] = empty($cekSubLocation->toArray());
        $data['villa'] = $villa;
        $data['location'] = $location;
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            'area_id' => 'required',
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
            'area_id' => $request->area_id,
        );

        $current = Location::findOrFail($id);
        $current->update($object);

        return redirect()->route('admin.location.index')
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $location = Location::where('id', $id)->firstOrFail();
        $location->delete();
        return redirect()->route('admin.location.index')
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
