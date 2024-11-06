<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;
use Hash;
use Storage;
use Validator;
use File;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:country-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $countries = Countries::all();
        // dd($Countries);
        $data["page_title"] = 'Manajemen Countries';
        $data['countries'] = $countries;
        return view('admin.countrie.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["page_title"] = 'Tambah Countries';
        $data['edit_password'] = true;
        return view('admin.countrie.form_countries', $data);
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
            // 'image' => 'required|file|mimes:jpg,png',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            // 'file' => 'The :attribute must be a file.',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $object = array(
            'name' => $request->name,
            'image' => 0,
        );

        // dd($object);
        // if ($request->has('image')) {
        //     $image = Storage::disk('uploads')->put('countries', $request->image);
        //     $object['image'] = $image;
        // }

        Countries::create($object);
        return redirect()->route('admin.countries.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function edit(Countries $countries, $id)
    {
        //
        $countries = Countries::find($id);
        // dd($countries->toArray());
        $data['page_title'] = 'Update Countries';
        $data['edit_mode'] = true;
        $data['countries'] = $countries;
        return response()->json($data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $countries, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            // 'image' => 'file|mimes:jpg,png',
        );
        // dd($rules);
        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
            // 'file' => 'The :attribute must be a file.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = array(
            'name' => $request->name,
            'image' => 0,
        );

        $current = Countries::findOrFail($id);

        // if ($request->has('image')) {
        //     $image = Storage::disk('uploads')->put('countries', $request->image);
        //     $object['image'] = $image;
        //     // dd($object['avatar']);
        //     if ($current->image) {
        //         File::delete('./uploads/' . $current->image);
        //     }
        // }

        $current->update($object);

        return redirect()->route('admin.countries.index')
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $countries, $id)
    {
        //
        $countries = Countries::where('id', $id)->firstOrFail();
        File::delete('./uploads/' . $countries->image);
        $countries->delete();
        return redirect()->route('admin.countries.index')
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
