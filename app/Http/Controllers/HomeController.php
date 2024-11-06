<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villas;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["page_title"] = ''; return view('home', $data);
    }

    public function maps()
    {
        
        $villas = Villas::latest()->get();
        $data['villas'] = $villas;
        //  dd($data);  
        // return view('admin.point.index', $data);
        return view('map', $data);
    }
    public function villa($slug)
    {
        
        $villas = Villas::where('slug',$slug)->first();
        $data['villas'] = $villas;
        $data['page_title'] = $villas->name;
        // dd($data);  
        // return view('admin.point.index', $data);
        return view('villas', $data);
    }
    public function geojson()
    {
        $points = Villas::latest()->get();
        return $points->toJson();
    }
    public function villajson($id)
    {
        $points = Point::where('villa_id',$id)->latest()->get();
        $villas = Villas::find($id);
        $data['points'] = $points;
        $data['villas'] = $villas;
        return $data;
    }
    public function getpoint(Request $request)
    {
        $id = $request->input('id');
        $points = Point::find($id);
         //dd($points);
        if($points==null){
            return '[]';
        }else{
            return $points->toJson();
        }
        // return $points->toJson();
    }
}
