<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Storage;
use Validator;
use File;
use Carbon\Carbon;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
        $permission = Permission::all();
        // dd($permission->toArray());
        $data["page_title"] = 'Manajemen Permission';
        $data['permission'] = $permission;
        return view('admin.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["page_title"] = 'Tambah Permission';
        return view('admin.permission.form_permission', $data);
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
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());

        foreach ($request->name as $key => $value) {
            $input['name'] = $value;
            $input['guard_name'] = 'web';
            Permission::create($input);
        }
        // dd($input);
        return redirect()->route('admin.permission.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = permission::find($id);

        $data['page_title'] = 'Update Permission';
        $data['edit_mode'] = true;
        $data['permission'] = $permission;
        return view('admin.permission.form_permission', $data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name' => 'required',
        );
        // dd($rules);
        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = array(
            'name' => $request->name,
            'guard_name' => 'web',
        );

        $current = Permission::findOrFail($id);

        $current->update($object);
        return redirect()->route('admin.permission.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permission = Permission::where('id', $id)->firstOrFail();
        $permission->delete();
        return redirect()->route('admin.permission.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
