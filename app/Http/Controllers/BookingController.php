<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rates;
use App\Models\Villas;
use Illuminate\Http\Request;

use Storage;
use Validator;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:booking-list|booking-create|booking-edit|booking-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:booking-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
        $booking = Booking::with('rate', 'villa')->get();
        // dd($booking->toArray());
        $data["page_title"] = 'Manajemen Booking';
        $data['booking'] = $booking;
        return view('admin.booking.index', $data);
    }

    public function draft_booking()
    {
        //
        $data["page_title"] = 'Manajemen Booking';
        return view('admin.booking.draft_booking', $data);
    }

    public function post_draft(Request $request)
    {
        if ($request->input('booking_id') != "") {
            $object = array(
                'rate_id' => '1234',
                'villa_id' => '1234',
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'start_date' => '2023-09-08 03:16:07',
                'end_date' => '2023-09-08 03:16:07',
                'rate_type' => 'base',
                'rate_price' => '1234',
                'rate_total' => '1234',
                'rate_price' => '1234',
                'status_data' => 'draft',
            );
            $insertedId = DB::table('bookings')->insertGetId($object);
            echo $insertedId;
        } else {
            $object = array(
                'rate_id' => '1234',
                'villa_id' => '1234',
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'start_date' => '2023-09-08 03:16:07',
                'end_date' => '2023-09-08 03:16:07',
                'rate_type' => 'base',
                'rate_price' => '1234',
                'status_data' => 'draft',
            );
            $booking = Booking::findOrFail($request->input('booking_id'));
            $booking->update($object);
        }
    }

    public function update_draft(Request $request)
    {

        if ($request->input('booking_id') == "") {
            $object = array(
                'rate_id' => '1234',
                'villa_id' => '1234',
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'start_date' => '2023-09-08 03:16:07',
                'end_date' => '2023-09-08 03:16:07',
                'rate_type' => 'base',
                'rate_price' => '1234',
                'rate_total' => '1234',
                'rate_price' => '1234',
                'status_data' => 'draft',
            );
            $insertedId = DB::table('bookings')->insertGetId($object);
            echo $insertedId;
        } else {
            $object = array(
                'rate_id' => '1234',
                'villa_id' => '1234',
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'start_date' => '2023-09-08 03:16:07',
                'end_date' => '2023-09-08 03:16:07',
                'rate_type' => 'base',
                'rate_price' => '1234',
                'status_data' => 'draft',
            );
            $booking = Booking::findOrFail($request->input('booking_id'));
            $booking->update($object);
        }



        // Insert the data and get the ID of the inserted record



        // $draft = $user->drafts()->firstOrNew([]); // Get the user's existing draft or create a new one
        // $draft->content = $request->input('content');
        // $draft->save();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // $rate = Rates::whereBetween([
    //         ['start_date', $dateS . " 00:00:00"],
    //         ['end_date', $dateE . " 23:59:59"],
    //     ])->get();
    public function create()
    {
        $rate = Rates::all();
        $villa = Villas::all();
        $data["page_title"] = 'Tambah Booking';
        $data['rate'] = $rate;
        $data['villa'] = $villa;
        //dd($rate->toArray());
        return view('admin.booking.form_booking', $data);
    }


    public function get_date(Request $request)
    {
        
        
        $villa = $request->villa;
        $type = $request->type; 
        
        //dd($request->all());
        $detail = Villas::where('id', $villa) 
            ->with(['rate' => function ($query) use ($type) {
                $query->where('type', $type);
            }])
            ->first();
        //dd($detail);
            if ($detail) {
    $rate = $detail->rate->pluck('name', 'id');
} else {
    $rate = [];
}
    
        $data['detail'] = $detail;
        $data['rate'] = $rate;

        return response()->json($data);
    }

    public function get_price(Request $request)
    {
        // dd($request->all());
        $rate = Rates::find($request->id);
        $start_date = new Carbon($request->start_date);
        $end_date = new carbon($request->end_date);
        $selisih = $start_date->diff($end_date);
        $harga = $rate->price * $selisih->days;
         //dd($harga);
          //dd($rate->toArray(), $selisih->days, $harga);

        $data['rate'] = $rate;
        $data['harga'] = $harga;

        return response()->json($data);
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
            'rate_id' => 'required',
            'villa_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rate_type' => 'required',
            'rate_price' => 'required',
            'rate_total' => 'required',
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
            'rate_id' => $request->rate_id,
            'villa_id' => $request->villa_id,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rate_type' => $request->rate_type,
            'rate_price' => $request->rate_price,
            'rate_total' => $request->rate_total,
            // 'status_data' => 'Post',
        );

        Booking::create($object);
        return redirect()->route('admin.booking.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $rate = Rates::all();
        $villa = villas::all();
        $booking = Booking::with('rate')->find($id);
        //dd($booking->toArray());
        $data['page_title'] = 'Update Booking';
        $data['edit_mode'] = true;
        $data['rate'] = $rate;
        $data['booking'] = $booking;
        $data['villa'] = $villa;
        return view('admin.booking.form_booking', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'rate_id' => 'required',
            'villa_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rate_type' => 'required',
            'rate_price' => 'required',
            'rate_total' => 'required',
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
            'rate_id' => $request->rate_id,
            'villa_id' => $request->villa_id,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rate_type' => $request->rate_type,
            'rate_price' => $request->rate_price,
            'rate_total' => $request->rate_total,
            // 'status_data' => 'Post',
        );

        $booking = Booking::findOrFail($id);
        $booking->update($object);
        return redirect()->route('admin.booking.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $booking = Booking::where('id', $id)->firstOrFail();
        $booking->delete();
        return redirect()->route('admin.booking.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }
}
