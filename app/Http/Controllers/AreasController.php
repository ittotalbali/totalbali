<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Countries;
use App\Models\Location;
use App\Models\Villas;
use Illuminate\Http\Request;
use Storage;
use Validator;
use File;


class AreasController extends Controller
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
        $area = Areas::with('countries')->get();
        $countrie = Countries::all();
        // dd($area);
        $data["page_title"] = 'Manajemen Area';
        $data['area'] = $area;
        $data['countrie'] = $countrie;
        return view('admin.area.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd('aa');
        $countries = Countries::all();
        $data["page_title"] = 'Tambah Area';
        $data['countries'] = $countries;
        return view('admin.area.form_area', $data);
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
            'country_id' => 'required',
        );

        // dd($request->all());
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
            'country_id' => $request->country_id,
        );

        Areas::create($object);
        return redirect()->route('admin.area.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function show(Areas $areas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function edit(Areas $areas, $id)
    {
        //
        $countries = Countries::all();
        $area = Areas::find($id);
        // dd($countries->toArray());
        $data['page_title'] = 'Update Area';
        $data['edit_mode'] = true;
        $data['countries'] = $countries;
        $data['area'] = $area;
        return response()->json($data);
    }

    public function cek_data(Areas $areas, $id)
    {
        //
        $area = Areas::find($id);
        
        $cekLocation = Location::where('area_id', $id)->get();
        $cekVilla = Villas::where('area_id', $id)->get();

        // dd(empty($cekVilla->toArray()));
        // dd($countries->toArray());
        if (empty($cekVilla->toArray()) == false) {
            $villa = '<li>Villa</li>';
        } else {
            $villa = '';
        }
        $data['page_title'] = 'Cek DAta';
        $data['validasi'] = empty($cekLocation->toArray());
        $data['villa'] = $villa;
        $data['area'] = $area;
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Areas $areas, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            'country_id' => 'required',
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
            'country_id' => $request->country_id,
        );

        $area = Areas::findOrFail($id);
        $area->update($object);
        return redirect()->route('admin.area.index')
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Areas $areas, $id)
    {
        //
        $area = Areas::where('id', $id)->firstOrFail();
        $area->delete();
        return redirect()->route('admin.area.index')
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    
    }
}
