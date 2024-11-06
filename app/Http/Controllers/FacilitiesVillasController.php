<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Facilities_villas;
use App\Models\Villas;
use Illuminate\Http\Request;
use Storage;
use Validator;
use File;

class FacilitiesVillasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd('yuda');
        $facil = Facilities_villas::with('facilities', 'villas')->get();
        // dd($facil->toArray());
        $data["page_title"] = 'Manajemen Facillity Villas';
        $data['facil'] = $facil;
        return view('admin.facility_villa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $facilities = Facilities::all();
        // dd($facilities->toArray());
        $villas = Facilities::all();
        $data["page_title"] = 'Tambah Facility Villa';
        $data['facilities'] = $facilities;
        $data['villas'] = $villas;
        return view('admin.facility_villa.form_facility_villa', $data);
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
            'villa_id' => 'required',
            'facility_id' => 'required',
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
            'villa_id' => $request->villa_id,
            'facility_id' => $request->facility_id,
        );

        Facilities_villas::create($object);
        return redirect()->route('admin.facility_villa.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facilities_villas  $facilities_villas
     * @return \Illuminate\Http\Response
     */
    public function show(Facilities_villas $facilities_villas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facilities_villas  $facilities_villas
     * @return \Illuminate\Http\Response
     */
    public function edit(Facilities_villas $facilities_villas, $id)
    {
        //
        $facilities = Facilities::all();
        $villas = Facilities::all();
        $facil = Facilities_villas::where('id', $id)
            ->with('villas')->first();
        // dd($villas->toArray());
        $data['page_title'] = 'Update Facility Villas';
        $data['edit_mode'] = true;
        $data['facilities'] = $facilities;
        $data['villas'] = $villas;
        $data['facil'] = $facil;
        return view('admin.facility_villa.form_facility_villa', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facilities_villas  $facilities_villas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'villa_id' => 'required',
            'facility_id' => 'required',
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
            'villa_id' => $request->villa_id,
            'facility_id' => $request->facility_id,
        );

        $facil = Facilities_villas::findOrFail($id);
        $facil->update($object);
        return redirect()->route('admin.facility_villa.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facilities_villas  $facilities_villas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $facil = Facilities_villas::where('id', $id)->firstOrFail();
        $facil->delete();
        return redirect()->route('admin.facility_villa.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
