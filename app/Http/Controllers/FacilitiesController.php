<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Villas;
use Illuminate\Http\Request;
use DB;
use Validator;
use File;
use Storage;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:faciliti-list|faciliti-create|faciliti-edit|faciliti-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:faciliti-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faciliti-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faciliti-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $faciliti = Facilities::all();
        // dd('facilities');
        // dd($facilities->toArray());
        $data["page_title"] = 'Manajemen Facilities';
        $data['faciliti'] = $faciliti;
        return view('admin.facilities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["page_title"] = 'Tambah Facilities';
        return view('admin.facilities.form_facilities', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //\
        $rules = array(
            'name' => 'required',
            'image' => 'required|file|mimes:jpg,png',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            'file' => 'The :attribute must be a file.',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $object = array(
            'name' => $request->name,
            'description' => $request->description,
        );

        if ($request->has('image')) {
            $image = Storage::disk('uploads')->put('facilities', $request->image);
            $object['image'] = $image;
        }

        Facilities::create($object);
        return redirect()->route('admin.faciliti.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function show(Facilities $facilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function edit(Facilities $facilities, $id)
    {
        //
        $faciliti = Facilities::find($id);
        $data['page_title'] = 'Update Facilities';
        $data['edit_mode'] = true;
        $data['faciliti'] = $faciliti;
        return view('admin.facilities.form_facilities', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'image' => 'file|mimes:jpg,png',
        );
        $validator = Validator::make($request->all(), $rules, $messages = [
                'required' => 'The :attribute field is required.',
                'file' => 'The :attribute must be a file.',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = array(
            'name' => $request->name,
            'description' => $request->description,
        );

        $current = Facilities::findOrFail($id);

        if ($request->has('image')) {
            $image = Storage::disk('uploads')->put('facilities', $request->image);
            $object['image'] = $image;
            // dd($object['avatar']);
            if ($current->image) {
                File::delete('./uploads/' . $current->image);
            }
        }

        $current->update($object);

        return redirect()->route('admin.faciliti.index')
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    public function cek_data(Facilities $facilities, $id)
    {
        //
        
        $faciliti = Facilities::with('villas')->find($id);

        $cekVilla = Villas::where('location_id', $id)->get();

        // dd(($faciliti->toArray()));
        // dd($countries->toArray());
        if (empty($cekVilla->toArray()) == false) {
             $villa = '<li>Villa</li>';
        } else {
             $villa = '';
        }
        $data['page_title'] = 'Cek DAta';
        // $data['villa'] = $cekVilla;
        $data['faciliti'] = $faciliti;
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facilities  $facilities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facilities $facilities, $id)
    {
        //
        $facilities = Facilities::where('id', $id)->firstOrFail();
        // dd($facilites->toArray());
        File::delete('./uploads/' . $facilities->image);
        $facilities->delete();
        
        return redirect()->route('admin.faciliti.index')
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
