<?php

namespace App\Http\Controllers;

use App\Models\User;
use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\VerifyMail;

use App\Http\Requests\StoreauthRequest;
use App\Http\Requests\UpdateauthRequest;
use App\Models\Permission;
use Facade\FlareClient\Http\Client;
use GuzzleHttp\Client as GuzzleHttpClient;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission(){
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),
            'token'   => 'Tokennya 12345689'
        ], 200);
    }
    public function index()
    {
        // dd(Auth::user()->role);
        if (Auth::check() == false) {
            $data["page_title"] = 'Login';
            return view('auth.login', $data);
        } else {
            if (Auth::user()->role == 'admin') {
                // return redirect('admin/dashboard');
                return redirect()->route('admin.villa.search');
            } else {
                // return redirect('admin/dashboard');
                return redirect()->route('admin.villa.search');
            }
        }
        // //
        // $data['header'] = 'Login';
        // return view('admin/login', $data);
    }


    public function proses_login(Request $request)
    {
        // dd('aa');
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ], [
            'required' => 'The :attribute field is required.',
            'min' => 'the :attribute field is required 8 characters.',
        ]);
        // $user = Auth::user();
        // dd(Auth::attempt($validator));
        if (Auth::attempt($validator)) {
            // dd(Auth::user()->email_verified_at);
            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return redirect('login')->with(['notif_status' => '0', 'notif' => 'Cek email untuk melakukan verifikasi akun.']);
            } else if (Auth::user()->role == 'admin') {
                // return redirect('admin/dashboard');
                return redirect()->route('admin.villa.search');
            } else if (Auth::user()->role == 'staff') {
                // return redirect('admin/dashboard');
                return redirect()->route('admin.villa.search');
            } elseif (Auth::user()->role == 'user') {
                // return redirect('user/paket');
                dd('Anda Sebagai User');
            }
            return redirect('/')->with(['notif_status' => '0', 'notif' => 'Email dan Password tidak sesuai.']);
        }
        return redirect('login')->with(['notif_status' => '0', 'notif' => 'Email dan Password tidak sesuai.']);
    }


    public function verifyMail($token)
    {
        $user = User::where('token', $token)->first();
        $mytime = \Carbon\Carbon::now();
        // dd($mytime->toDateTimeString());
        $object = array(
            // 'email_verified_at' => $mytime->toDateTimeString(),
            'email_verified_at' => $mytime->toDateTimeString(),
        );
        $current = User::find($user->id);
        $current->update($object);
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }

    public function forgot()
    {
        $data['title'] = 'Lupa Password';
        return view('auth.forgot_password', $data);
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
     * @param  \App\Http\Requests\StoreauthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreauthRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function show(auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function edit(auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateauthRequest  $request
     * @param  \App\Models\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateauthRequest $request, auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function destroy(auth $auth)
    {
        //
    }
}
