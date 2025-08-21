<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Storage;
use Validator;
use File;
use Carbon\Carbon;
use App\Mail\VerifyMail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        $user = User::all();
        // dd($user);
        $data["page_title"] = 'Manajemen User';
        $data['user'] = $user;
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();

        $data["page_title"] = 'Tambah User';
        $data['edit_password'] = true;
        $data['roles'] = $roles;
        return view('admin.user.form_user', $data);
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
            'role' => 'required',
            'no_hp' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'image' => 'required|file|mimes:jpg,png',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            'file' => 'The :attribute must be a file.',
            'min' => 'the :attribute field is required 8 characters.',
            'email.unique' => 'The :attribute field already registered .',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $token = Str::random(60);

        // dd($request->password);
        $object = array(
            // 'image' => $request->image,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => Str::lower($request->role),
            'no_hp' => $request->no_hp,
            'email_verified_at' => date('Y-m-d'),
            'token' => $token,
        );

        // dd($object);
        if ($request->has('image')) {
            $image = Storage::disk('uploads')->put('user', $request->image);
            $object['image'] = $image;
        }
        // dd($object['image']);
        // Mail::to($request->email)->send(new VerifyMail($object, $token));

        $user = User::create($object);
        $id_role = DB::table('roles')->where('name', Str::lower($request->role))->first();
        // dd($id_role->id);
        $user->assignRole($id_role->id);

        // dd($user->assignRole($request->input('roles')));

        return redirect()->route('admin.user.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        // dd($user->toArray());
        $data['page_title'] = 'Update User';
        $data['edit_mode'] = true;
        $data['edit_password'] = false;
        $data['user'] = $user;
        $data['roles'] = $roles;
        return view('admin.user.form_user', $data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'image' => 'file|mimes:jpg,png',
        );
        // dd($rules);
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
            'email' => $request->email,
            'role' => Str::lower($request->role),
            'no_hp' => $request->no_hp,
        );

        $current = user::findOrFail($id);

        if ($request->has('image')) {
            $image = Storage::disk('uploads')->put('user', $request->image);
            $object['image'] = $image;
            // dd($object['avatar']);
            if ($current->image) {
                File::delete('./uploads/' . $current->image);
            }
        }

        $current->update($object);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $id_role = DB::table('roles')->where('name', Str::lower($request->role))->first();
        // dd($id_role->id);
        $current->assignRole($id_role->id);

        return redirect()->route('admin.user.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request, $id)
    {
        $rules = [
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|same:new_password',
        ];
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            'min' => 'the :attribute field is required 8 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = User::find($id);
        $data->password = Hash::make($request->new_password);
        $data->save();

        return redirect()->route('admin.user.index')->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    public function destroy($id)
    {
        //
        $user = User::where('id', $id)->firstOrFail();
        File::delete('./uploads/' . $user->image);
        $user->delete();
        return redirect()->route('admin.user.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
