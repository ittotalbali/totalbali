<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Areas;
use App\Models\Bathroom;
use App\Models\BeachVilla;
use App\Models\bedroom;
use App\Models\CarAndDrive;
use App\Models\Chef;
use App\Models\CloseToTheClubs;
use App\Models\Countries;
use App\Models\Facilities;
use App\Models\Facilities_villas;
use App\Models\FamilyVilla;
use App\Models\Floorplan;
use App\Models\Galeri;
use App\Models\GaleriVilla;
use App\Models\GambarFloorplan;
use App\Models\Inclusions;
use App\Models\Location;
use App\Models\MountainVilla;
use App\Models\Pool;
use App\Models\Pricing;
use App\Models\Rates;
use App\Models\Retreats;
use App\Models\StaffAtVilla;
use App\Models\SubLocation;
use App\Models\Villas;
use App\Models\User;
use App\Models\WeddingVilla;
use App\Models\Calender;
use App\Models\Service\Service;
use App\Services\AlbumCategory\GetAlbumCategoryService;
use App\Services\Currency\GetCurrencyService;
use App\Services\Service\GetServiceService;
use App\Services\VillaManagement\Club\DeleteClubService;
use App\Services\VillaManagement\Club\GetClubService;
use App\Services\VillaManagement\Club\StoreClubService;
use App\Services\VillaManagement\Club\UpdateClubService;
use App\Services\VillaManagement\FamilyVilla\StoreFamilyVillaService;
use App\Services\VillaManagement\FamilyVilla\UpdateFamilyVillaService;
use App\Services\VillaManagement\Rate\GetRateService;
use App\Services\VillaManagement\Rate\StoreRateService;
use App\Services\VillaManagement\Rate\UpdateRateService;
use App\Services\VillaManagement\Villa\GetVillaService;
use App\Services\VillaManagement\WeddingVilla\StoreWeddingVillaService;
use App\Services\VillaManagement\WeddingVilla\UpdateWeddingVillaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Validator;
use File;
use DB;
use Illuminate\Support\Facades\Auth;

class VillasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:villa-list|villa-create|villa-edit|villa-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:villa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:villa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:villa-delete', ['only' => ['destroy']]);
    }

    public function index(GetVillaService $getVillaService)
    {
        //
        // $id_user = Auth::user()->id;
        // if(Auth::user()->roles[0]->name == 'super_admin'){
        //     // dd('1');
        //     $villa = Villas::with('countries', 'area')->latest()->limit(10)->get(); // limit 10 for dev only
        // }else{
        //     $villa = Villas::where('user_id', $id_user)->with('countries', 'area')->latest()->get();
        //     // $villa = User::where('id', $id_user)->with(['villa' => function ($query) {
        //     //     return $query->with('countries', 'area')->latest();
        //     // }])->first();
        // }
        // $villa = Villas::with(['countries', 'area', 'user' => function ($query) use ($id_user) {
        //     $query->where('id', $id_user);
        // }])->get();
        // dd($villa->toArray());

        $user = Auth::user();
        
        $villa = $getVillaService->execute([
            // 'user_id' => $user->roles[0]->name == 'super_admin' ? null : $user->id,
            // 'limit' => 100 // dev only
        ])->data;

        $data["page_title"] = 'Manajemen Villa';
        $data['villa'] = $villa;

        return view('admin.villa.index', $data);
    }
    
     //rino
    public function genrate(GetVillaService $getVillaService)
    {        
        $villa = $getVillaService->execute()->data;
        $rate = Rates::all();
        $data["page_title"] = 'Manajemen Villa';
        $data['villa'] = $villa;
        $data['rate'] = $rate;

        return view('admin.villa.generate', $data);
    }
    //endrino

    public function draft_villa()
    {
        //
        $villa = Villas::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->role == 'owner') {
            if (count($villa) >= 5) {
                return redirect()->route('admin.villa.index')->with(['notif_status' => '3', 'notif' => 'you can only add 5 villas. !!!']);
            }
        }
        // dd(count($villa));
        $countries = Countries::all();
        $country = Countries::all();
        $data['country'] = $country;
        $area = Areas::all();
        $faciliti = Facilities::all();
        $data["page_title"] = 'Tambah Villa';
        $data['countries'] = $countries;
        $data['country'] = $country;
        $data['area'] = $area;
        $data['faciliti'] = $faciliti;
        return view('admin.villa.draft_villa', $data);
    }

    public function post_draft_villa(Request $request)
    {
        // dd($request->all());
        // dd($request->count_album, $request->all());
        // foreach ($request->nama_album as $key => $value) {
        //     $data[$key]['nama_album'] = $request->nama_album[$key];
        //     $data[$key]['deskripsi_album'] = $request->deskripsi_album[$key];
        //     $data[$key]['caption'] = $request->title_album[$key];
        //     // $data[$key]['image'] = $request->image_album[$key];
        // }
        // dd($request->all());
        if (
            $request->name &&
            $request->type_accomodation &&
            $request->privacy_type &&
            $request->guest &&
            $request->bedroom &&
            $request->bed &&
            $request->bathroom &&
            $request->staff &&
            $request->landsize &&
            $request->buildingsize &&
            $request->yearbuilt &&
            $request->last_renovation &&
            $request->faciliti &&
            $request->pets &&
            $request->wheelchair_friendly &&
            $request->internet &&
            $request->short &&
            $request->long &&
            $request->old_link &&
            $request->new_link &&
            $request->airbnb_link &&
            $request->bookingcom_link &&
            $request->base_rate &&
            $request->base_rate_currency &&
            $request->security_night &&
            $request->security_day &&
            $request->security_cctv &&
            $request->country_id &&
            $request->area_id &&
            $request->location_id &&
            $request->sub_location_id &&
            $request->address &&
            $request->link_map &&
            $request->extra_guest_charge &&
            $request->max_guests &&
            $request->cor_lat &&
            $request->cor_long != null
        ) {
            $statusPost = 'post';
        } else {
            $statusPost = 'draft';
        }

        if(!empty($request->sub_location_id) and !empty($request->location_id)) {
            $bedroom = $request->bedroom ?? 0;
            $bathroom = $request->bathroom ?? 0;
    
            $location = Location::find($request->location_id);
            // $sub_location = SubLocation::find($request->sub_location_id);
            // $sub_location_villa_count = Villas::where('sub_location_id', $request->sub_location_id)->count() + 1;
            // $formatted_villa_count = str_pad($sub_location_villa_count, 3, '0', STR_PAD_LEFT);

            $villa_codes = Villas::where('location_id', $request->location_id)->pluck('code')->toArray();
            $counters = [];

            foreach($villa_codes as $villa_code) {
                $counters[] = substr($villa_code, -3);
            }

            $last_count = max($counters) + 1;
            $formatted_villa_count = str_pad($last_count, 3, '0', STR_PAD_LEFT);
    
            $code = $location->name . '-' . $bedroom . $bathroom . $formatted_villa_count;
        }

        $villaId = Villas::insertGetId([
            'name' => $request->name,
            'type_accomodation' => $request->type_accomodation,
            'privacy_type' => $request->privacy_type,
            'guest' => $request->guest,
            'bedroom' => $request->bedroom,
            'bed' => $request->bed,
            'bathroom' => $request->bathroom,
            'staff' => $request->staff,
            'landsize' => $request->landsize,
            'buildingsize' => $request->buildingsize,
            'yearbuilt' => $request->yearbuilt,
            'last_renovation' => $request->last_renovation,
            'pets' => $request->pets,
            'wheelchair_friendly' => $request->wheelchair_friendly,
            'internet' => $request->internet,
            'code' => $code ?? null,
            'title' => $request->title,
            'short' => $request->short,
            'long' => $request->long,
            'old_link' => $request->old_link,
            'new_link' => $request->new_link,
            'airbnb_link' => $request->airbnb_link,
            'bookingcom_link' => $request->bookingcom_link,
            'base_rate' => $request->base_rate,
            'base_rate_currency' => $request->base_rate_currency,
            'security_cctv' => $request->security_cctv,
            'security_night' => $request->security_night,
            'security_day' => $request->security_day,
            'country_id' => $request->country_id,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id,
            'sub_location_id' => $request->sub_location_id,
            'address' => $request->address,
            'link_map' => $request->link_map,
            'extra_guest_charge' => $request->extra_guest_charge,
            'max_guests' => $request->max_guests,
            'cor_lat' => $request->cor_lat,
            'cor_long' => $request->cor_long,
            'status' => $statusPost,
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'villa_bvp' => $request->villa_bvp,
        ]);
        $current = Villas::findOrFail($villaId);
        $current->facilities()->attach($request->faciliti);
        $current->services()->attach($request->service);

        if ($request->file('image') != null) {
            foreach ($request->file('image') as $key => $value) {
                $image = Storage::disk('uploads')->put('galeri_villa', $value);
                $input['image'] = $image;
                $input['title'] = $key;
                $input['villa_id'] = $villaId;
                GaleriVilla::create($input);
            }
        }
        $getIdBedroom = [];
        if ($request->number_of_bedroom != null) {
            foreach ($request->number_of_bedroom as $key => $value) {
                
                $data_bedroom = [
                    'number_of_bedrooms' => $request->number_of_bedroom[$key],
                    'type_of_bedroom' => $request->type_of_bedroom[$key],
                    'people_can_stay_per_room' => $request->people_can_stay_per_room[$key],
                    'id_villa' => $villaId, // Replace with the appropriate villa ID
                ];
                $idBedroom = bedroom::insertGetId($data_bedroom);
                $getIdBedroom[] = $idBedroom;
            }

            foreach ($getIdBedroom as $key => $value) {
                $data_bathroom = [
                    'type_of_bathroom' => $request->type_of_bathroom[$key],
                    'id_bedroom' => $value,
                    'id_villa' => $villaId, // Replace with the appropriate villa ID
                ];
                $bathroomData[] = $data_bathroom;
                Bathroom::insert($bathroomData);
            }
        }

        if ($request->nama_album[0] != null) {
            foreach ($request->nama_album as $key => $value) {
                $input_album['nama'] = $request->nama_album[$key];
                $input_album['deskripsi'] = $request->deskripsi_album[$key];
                $input_album['thumbnail'] = 0;
                $input_album['id_villa'] = $villaId;
                $input_album['album_category_id'] = $request->album_category[$key];
               
                $album_id = Album::insertGetId($input_album);
                if ($request->image_album != null) {
                    foreach ($request->image_album[$key] as $index => $image) {
                        $image = Storage::disk('uploads')->put('galeri_album', $image);
                        $galery_album['album_id'] = $album_id;
                        $galery_album['villa_id'] = $villaId;
                        $galery_album['title'] = $request->title_album[$key][$index];
                        $galery_album['image'] = $image;
                        $galery_album['order_number'] = $request->order_number[$key][$index];

                        Galeri::insert($galery_album);
                    }
                }
            }
        }
        

        if ($request->nama_floorplan != null) {
            $data_floorplan = [
                'nama' => $request->nama_floorplan,
                'deskripsi' => $request->deskripsi,
                'id_villa' => $villaId,
            ];
            $idAlbumFloorplan = Floorplan::insertGetId($data_floorplan);
            if ($request->hasfile('image_floorplan')) {
                foreach ($request->file('image_floorplan') as $key => $value) {
                    $image = Storage::disk('uploads')->put('galeri_floorplan', $value);
                    $input['gambar'] = $image;
                    $input['deskripsi'] = $request->deskripsi_floorplan[$key];
                    $input['id_floorplan'] = $idAlbumFloorplan;
                    $input['id_villa'] = $villaId;
                    GambarFloorplan::create($input);
                }
            }
        }
        if ($request->pool != null) {
            $data_pool = [
                'pool' => $request->pool,
                'type' => $request->type,
                'size_of_pool' => $request->size_of_pool,
                'id_villa' => $villaId,
            ];
            Pool::insert($data_pool);
        }

        if ($request->breakfast != null) {
            $data_inclusions = [
                'breakfast' => $request->breakfast,
                'breakfast_description' => $request->breakfast_description,
                'airport' => $request->airport,
                'airport_description' => $request->airport_description,
                'pijet' => $request->pijet,
                'pijet_description' => $request->pijet_description,
                'anything_else' => $request->anything_else,
                'anything_else_description' => $request->anything_else_description,
                'id_villa' => $villaId,
            ];
            Inclusions::insert($data_inclusions);
        }
        if ($request->workout_deck != null) {
            $data_retreats = [
                'workout_deck' => $request->workout_deck,
                'house_chef' => $request->house_chef,
                'exclusive_rental' => $request->exlusive_rental,
                'views_from_workout' => $request->views_from_workout,
                'gym' => $request->gym,
                'id_villa' => $villaId,
            ];
            Retreats::insert($data_retreats);
        }
        if ($request->standing_guests != null) {
            $data_wedding_villa = [
                'standing_guests' => $request->standing_guests,
                'seated_guests' => $request->seated_guests,
                'additional_function_fee' => $request->addtional_function_fee,
                'banjar_fee' => $request->banjar_fee,
                'security_deposit' => $request->security_deposit,
                'music_curfew' => $request->music_curfew,
                'other_informasion' => $request->other_informasion,
                'wedding_packages' => $request->wedding_packages,
                'wedding_packages_information' => $request->wedding_packages_information,
                'id_villa' => $villaId,
            ];
            WeddingVilla::insert($data_wedding_villa);
        }
        if ($request->mountain_view != null) {
            $data_mountain = [
                'mountain_view' => $request->mountain_view,
                'view_of_ricefield' => $request->view_of_ricefield,
                'river_closeby' => $request->river_closeby,
                'waterfall_closeby' => $request->waterfall_closeby,
                'activities' => $request->activities,
                'track_information' => $request->track_information,
                'birdwatching' => $request->birdwatching,
                'guide' => $request->guide,
                'id_villa' => $villaId,
            ];
            MountainVilla::insert($data_mountain);
        }
        if ($request->club_name != null) {
            $data_close_the_clubs = [
                'club_name' => $request->club_name,
                'type_of_club' => $request->type_of_club,
                'good_days' => $request->good_days,
                'id_villa' => $villaId,
            ];
            CloseToTheClubs::insert($data_close_the_clubs);
        }
        if ($request->pool_fence != null) {
            $data_family_villa = [
                'pool_fence' => $request->pool_fence,
                'baby_cot' => $request->baby_cot,
                'infant_cot' => $request->infant_cot,
                'baby_high_chair' => $request->baby_high_chair,
                'chef' => $request->chef_family_villa,
                'costs_for_chef' => $request->costs_for_chef,
                'nanny_cost' => $request->nanny_cost,
                'included' => $request->included,
                // 'photos' => $request->photos,
                'id_villa' => $villaId,
            ];
            if ($request->has('photos')) {
                $photos = Storage::disk('uploads')->put('familly_villa', $request->photos);
                $data_family_villa['photos'] = $photos;
            }
            FamilyVilla::insert($data_family_villa);
        }
        if ($request->what_beach != null) {
            $data_beach_villa = [
                'what_beach' => $request->what_beach,
                'how_far_walking' => $request->how_far_walking,
                'views_of_ocean' => $request->views_of_ocean,
                'surf_villa' => $request->surf_villa,
                'waves_nearby' => $request->waves_nearby,
                'extra_information' => $request->extra_information,
                'other_information' => $request->other_information,
                'id_villa' => $villaId,
            ];
            BeachVilla::insert($data_beach_villa);
        }
        if ($request->house_keeper != null) {
            $data_staf_villa = [
                'house_keeper' => $request->house_keeper,
                'satpam' => $request->satpam,
                'manager' => $request->manager,
                'chef' => $request->chef_staff,
                'gardener' => $request->gardener,
                'driver' => $request->driver,
                'other' => $request->other,
                'id_villa' => $villaId,
            ];
            StaffAtVilla::insert($data_staf_villa);
        }
        if ($request->chef != null) {
            $chef_cost_currency = is_array($request->chef_cost_currency) ? implode(',', $request->chef_cost_currency) : $request->chef_cost_currency;
            $data_chef = [
                'chef' => $request->chef,
                'cost' => $request->cost,
                'chef_cost_currency' => $chef_cost_currency,
                'information' => $request->information,
                'id_villa' => $villaId,
            ];
            Chef::insert($data_chef);
        }
        if ($request->system_for_use != null) {
            $car_currency = is_array($request->car_currency) ? implode(',', $request->car_currency) : $request->car_currency;
            $data_car = [
                'system_for_use' => $request->system_for_use,
                'car_currency' => $car_currency,
                'cost' => $request->cost_driver,
                'information' => $request->information,
                'id_villa' => $villaId,
            ];
            CarAndDrive::insert($data_car);
        }
        if ($request->monthly_rental != null) {
            $pricing = [
                'monthly_rental' => $request->monthly_rental,
                'monthly_description' => $request->monthly_description,
                'yearly_rental' => $request->yearly_rental,
                'yearly_description' => $request->yearly_description,
                'available_for_sales_rental' => $request->available_for_sales,
                'available_for_sales_description' => $request->available_for_sales_description,
                'long_term_rental' => $request->long_term_rental,
                'long_term_sales' => $request->long_term_sales,
                'freehold' => $request->freehold,
                'freehold_description' => $request->freehold_description,
                'leasehold' => $request->leasehold,
                'leasehold_description' => $request->leasehold_description,
                'id_villa' => $villaId,
                'monthly_currency' => $request->monthly_currency,
                'monthly_cost' => $request->monthly_cost,
                'yearly_currency' => $request->yearly_currency,
                'yearly_cost' => $request->yearly_cost,
                'available_for_sales_currency' => $request->available_for_sales_currency,
                'available_for_sales_cost' => $request->available_for_sales_cost,
                'long_term_rental_currency' => $request->long_term_rental_currency,
                'long_term_rental_cost' => $request->long_term_rental_cost,
                'freehold_currency' => $request->freehold_currency,
                'freehold_cost' => $request->freehold_cost,
                'leasehold_currency' => $request->leasehold_currency,
                'leasehold_cost' => $request->leasehold_cost,
                'leasehold_available_until' => $request->leasehold_available_until,
            ];
            Pricing::insert($pricing);
        }

        return redirect()->route('admin.villa.index')->with(['notif_status' => '1', 'notif' => 'Post Draft data succeed.']);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        GetCurrencyService $getCurrencyService,
        GetServiceService $getServiceService,
        GetAlbumCategoryService $getAlbumCategoryService,
    ) {
        //
        $villa = Villas::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->role == 'owner') {
            if (count($villa) >= 5) {
                return redirect()->route('admin.villa.index')->with(['notif_status' => '3', 'notif' => 'you can only add 5 villas. !!!']);
            }
        }
        // dd(count($villa));
        $countries = Countries::all();
        $country = Countries::all();
        $data['country'] = $country;
        $area = Areas::all();
        $faciliti = Facilities::all();
        $data["page_title"] = 'Tambah Villa';
        $data['countries'] = $countries;
        $data['country'] = $country;
        $data['area'] = $area;
        $data['faciliti'] = $faciliti;

        $data['master_currency'] = $getCurrencyService->execute([
            'sort_by' => 'name',
            'sort_type' => 'asc'
        ])->data;
        $data['master_service'] = $getServiceService->execute([
            'sort_by' => 'name',
            'sort_type' => 'asc'
        ])->data;
        $data['album_categories'] = $getAlbumCategoryService->execute([
            'sort_by' => 'id',
            'sort_type' => 'desc'
        ])->data;

        $data['year_list'] = range(date('Y'), 2100);

        return view('admin.villa.draft_villa', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'country_id' => 'required',
            'area_id' => 'required',
            'address' => 'required',
            'cor_lat' => 'required',
            'cor_long' => 'required',
            'privacy_type' => 'required',
        );

        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $villaId = Villas::insertGetId([
            'type_accomodation' => $request->type_accomodation,
            'privacy_type' => $request->privacy_type,
            'guest' => $request->guest,
            'bedroom' => $request->bedroom,
            'bed' => $request->bed,
            'bathroom' => $request->bathroom,
            'staff' => $request->staff,
            'landsize' => $request->landsize,
            'buildingsize' => $request->buildingsize,
            'yearbuilt' => $request->yearbuilt,
            'last_renovation' => $request->last_renovation,
            'pets' => $request->pets,
            'wheelchair_friendly' => $request->wheelchair_friendly,
            'security_day' => $request->security_day,
            'security_night' => $request->security_night,
            'security_cctv' => $request->security_cctv,
            'internet' => $request->internet,
            'code' => $request->code,
            'title' => $request->title,
            'short' => $request->short,
            'long' => $request->long,
            'old_link' => $request->old_link,
            'new_link' => $request->new_link,
            'base_rate' => $request->base_rate,
            'base_rate_currency' => $request->base_rate_currency,
            'camera' => $request->camera,
            'weapon' => $request->weapon,
            'animal' => $request->animal,
            'country_id' => $request->country_id,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id,
            'sub_location_id' => $request->sub_location_id,
            'address' => $request->address,
            'link_map' => $request->link_map,
            'extra_guest_charge' => $request->extra_guest_charge,
            'max_guests' => $request->max_guests,
            'cor_lat' => $request->cor_lat,
            'cor_long' => $request->cor_long,
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        // dd($request->faciliti);
        // foreach ($request->faciliti as $key => $value) {
        //     $input['villa_id'] = $villaId;
        //     $input['facility_id'] = $value;
        //     // dd($input);
        //     Facilities_villas::create($input);
        // }
        // foreach ($request->faciliti as $key => $value) {
        //     # code...
        //     if ($request->faciliti[$key] != null) {
        //         $facilities[$key] = $request->faciliti[$key];
        //     }
        // }
        $current = Villas::findOrFail($villaId);
        $current->facilities()->attach($request->faciliti);

        foreach ($request->file('image') as $key => $value) {
            $image = Storage::disk('uploads')->put('galeri_villa', $value);
            $input['image'] = $image;
            $input['title'] = $key;
            $input['villa_id'] = $villaId;
            GaleriVilla::create($input);
        }

        return redirect()->route('admin.villa.index')->with(['notif_status' => '1', 'notif' => 'Insert data succeed.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Villas  $villas
     * @return \Illuminate\Http\Response
     */
    public function show(Villas $villas, $id)
    {
        $villa = Villas::with([
            'countries', 'area', 'location', 'galeries', 'sublocation', 'pool','facilities','rate',
            'bedrooms' => function ($query) {
                return $query->with('bathrooms');
            }, 'inclusions', 'retreats', 'wedding', 'mountain', 'close_clubs', 'family', 'beach', 'staff_new', 'chef', 'car',
            'album' => function ($query) {
                return $query->with('galeri_album');
            },  'floorplan' => function ($query) {
                return $query->with('galeri_floorplan');
            }, 'pricing'
        ])->findorfail($id);
        // dd($villa->toArray());
        $data['edit'] = $villa;
        return view('admin.villa.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Villas  $villas
     * @return \Illuminate\Http\Response
     */

    public function kalender($id_villa)
    {
        //
        $data = Rates::where('villa_id', $id_villa)->orderBy('start_date')->get();
        // dd($data->toArray());
        $events = [];
        foreach ($data as $key => $value) {
            if ($value->type == 'base') {
                $bgColor = 'rgb(0,123,255, 50%)';
            } else if ($value->type == 'low') {
                $bgColor = 'rgb(23,162,184, 50%)';
            } else if ($value->type == 'peak') {
                $bgColor = 'rgb(255,0,0, 50%)';
            //belum ganti warna
            } else if ($value->type == 'special_rate') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else if ($value->type == 'peak_sesion') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else if ($value->type == 'low_sesion') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else if ($value->type == 'shoulder_sesion') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else if ($value->type == 'high_sesion') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else {
                $bgColor = 'rgb(255,164,27, 50%)';
            }

            $events[$key]['id'] = $value->id;
            $events[$key]['start'] = date('Y-m-d', strtotime($value->start_date)) . 'T00:00:00';
            $events[$key]['end'] = date('Y-m-d', strtotime($value->end_date)) . 'T24:00:00';
            $events[$key]['title'] = $value->name;
            $events[$key]['backgroundColor'] = $bgColor;
            $events[$key]['borderColor'] = 'rgba(68, 84, 195, 0.15)';
            // $events[$key]['description'] = $value->name;
        }
        // dd($data->toArray());
        return response()->json($events);
    }


    public function edit(
        GetCurrencyService $getCurrencyService,
        GetServiceService $getServiceService,
        GetAlbumCategoryService $getAlbumCategoryService,
        Villas $villas,
        $id
    ) {
        //
        $countries = Countries::all();
        $country = Countries::all();
        $villa = Villas::with([
            'countries', 'area', 'location', 'galeries', 'sublocation', 'pool',
            'bedrooms' => function ($query) {
                return $query->with('bathrooms');
            }, 'inclusions', 'retreats', 'wedding', 'mountain', 'close_clubs', 'family', 'beach', 'staff_new', 'chef', 'car',
            'album' => function ($query) {
                return $query->with('galeri_album');
            },  'floorplan' => function ($query) {
                return $query->with('galeri_floorplan');
            }, 'pricing'
        ])->findorfail($id);
        //  dd($villa->toArray());
        $area = Areas::where('country_id', $villa->country_id)->get();
        $lokasi = Location::where('area_id', $villa->area_id)->get();
        $sublokasi = SubLocation::where('location_id', $villa->location_id)->get();
        $rate = Rates::where('villa_id', $id)->get();
        $galeri = GaleriVilla::where('villa_id', $id)->get();
        $rate_base = Rates::where('villa_id', $id)->where('type', 'base')->get();
        $rate_low = Rates::where('villa_id', $id)->where('type', 'low')->get();
        $rate_high = Rates::where('villa_id', $id)->where('type', 'high')->get();
        $rate_low_season = Rates::where('villa_id', $id)->where('type', 'low_season')->get();
        $rate_high_season = Rates::where('villa_id', $id)->where('type', 'high_season')->get();
        $rate_special_rate = Rates::where('villa_id', $id)->where('type', 'special_rate')->get();
        $rate_shoulder_season = Rates::where('villa_id', $id)->where('type', 'shoulder_season')->get();
        $rate_peak_season = Rates::where('villa_id', $id)->where('type', 'peak_season')->get();
        $facility = Facilities_villas::where('villa_id', $id)->get();
        // dd($villa->toArray());

        
        $pool = Pool::where('id_villa', $id)->first();
        $bedroom = bedroom::where('id_villa', $id)->with('bathroom')->get();
        $inclusions = Inclusions::where('id_villa', $id)->get();
        $retreats = Retreats::where('id_villa', $id)->get();
        $wedding = WeddingVilla::where('id_villa', $id)->get();
        $mountain = MountainVilla::where('id_villa', $id)->get();
        $close_clubs = CloseToTheClubs::where('id_villa', $id)->get();
        $family = FamilyVilla::where('id_villa', $id)->get();
        $beach = BeachVilla::where('id_villa', $id)->get();
        $staff = StaffAtVilla::where('id_villa', $id)->get();
        $chef = Chef::where('id_villa', $id)->get();
        $car = CarAndDrive::where('id_villa', $id)->get();
        $album = Album::where('id_villa', $id)->with('galeri')->get();
        $floorplan = Floorplan::where('id_villa', $id)->with('gambar')->get();
        $pricing = Pricing::where('id_villa')->get();

        $faciliti = Facilities::with(['villa' => function ($query) use ($id) {
            return $query->where('villa_id', $id);
        }])->get();
        $lat = $villa->cor_lat;
        $long = $villa->cor_long;
        if ($lat && $long != null) {
            $cor_lat = $villa->cor_lat;
            $cor_long = $villa->cor_long;
        } else {
            $cor_lat = -8.334462508224263;
            $cor_long = 115.1163704915507;
        }

        $checked = Facilities_villas::with('facilities')->where('villa_id', $id)->get();
        $data['page_title'] = 'Update Villa';
        $data['pool'] = $pool;
        $data['bedroom'] = $bedroom;
        $data['inclusions'] = $inclusions;
        $data['retreats'] = $retreats;
        $data['wedding'] = $wedding;
        $data['mountain'] = $mountain;
        $data['close_clubs'] = $close_clubs;
        $data['family'] = $family;
        $data['beach'] = $beach;
        $data['staff'] = $staff;
        $data['chef'] = $chef;
        $data['car'] = $car;
        $data['album'] = $album;
        $data['floorplan'] = $floorplan;
        $data['pricing'] = $pricing;
        $data['cor_lat'] = $cor_lat;
        $data['cor_long'] = $cor_long;

        $data['rate'] = $rate;
        $data['facility'] = $facility;
        $data['countries'] = $countries;
        $data['area'] = $area;
        $data['rate_base'] = $rate_base;
        $data['rate_low_season'] =$rate_low_season;
        $data['rate_high_season'] =$rate_high_season;
        $data['rate_special_rate'] =$rate_special_rate;
        $data['rate_shoulder_season'] =$rate_shoulder_season;
        $data['rate_peak_season'] =$rate_peak_season;
        //rate
        $data['rate_low'] = $rate_low;
        $data['rate_high'] = $rate_high;
        $data['edit'] = $villa;
        $data['faciliti'] = $faciliti;
        $data['checked'] = $checked;
        $data['country'] = $country;
        $data['lokasi'] = $lokasi;
        $data['sublokasi'] = $sublokasi;
        $data['galeri'] = $galeri;

        $data['security_day'] = $villa->security_day;
        $data['security_night'] = $villa->security_night;
        $data['security_cctv'] = $villa->security_cctv;
        //coba
        //$data['chef_cost_currency'] = $chef->chef_cost_currency;

        $data['master_currency'] = $getCurrencyService->execute([
            'sort_by' => 'name',
            'sort_type' => 'asc'
        ])->data;
        $data['master_service'] = $getServiceService->execute([
            'sort_by' => 'name',
            'sort_type' => 'asc'
        ])->data;
        $data['album_categories'] = $getAlbumCategoryService->execute([
            'sort_by' => 'id',
            'sort_type' => 'desc'
        ])->data;

        $data['service_villa'] = $villa->services->pluck('id')->toArray();
        $data['year_list'] = range(date('Y'), 2100);

        return view('admin.villa.edit_draft', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Villas  $villas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        if (
            $request->name &&
            $request->type_accomodation &&
            $request->privacy_type &&
            $request->guest &&
            $request->bedroom &&
            $request->bed &&
            $request->bathroom &&
            $request->staff &&
            $request->landsize &&
            $request->buildingsize &&
            $request->yearbuilt &&
            $request->last_renovation &&
            $request->faciliti &&
            $request->pets &&
            $request->wheelchair_friendly &&
            $request->internet &&
            $request->code &&
            $request->short &&
            $request->long &&
            $request->old_link &&
            $request->new_link &&
            $request->airbnb_link &&
            $request->bookingcom_link &&
            $request->base_rate &&
            $request->base_rate_currency &&
            $request->security_night &&
            $request->security_day &&
            $request->security_cctv &&
            $request->country_id &&
            $request->area_id &&
            $request->location_id &&
            $request->sub_location_id &&
            $request->address &&
            $request->link_map &&
            $request->extra_guest_charge &&
            $request->max_guests &&
            $request->cor_lat &&
            $request->cor_long != null
        ) {
            $statusPost = 'post';
        } else {
            $statusPost = 'draft';
        }

        // Generate villa code
        if(!empty($request->sub_location_id) and !empty($request->location_id)) { // used empty($request->code) filter before
            $bedroom = $request->bedroom ?? 0;
            $bathroom = $request->bathroom ?? 0;

            $location = Location::find($request->location_id);
            // $sub_location = SubLocation::find($request->sub_location_id);
            // $sub_location_villa_count = Villas::where('sub_location_id', $request->sub_location_id)->count() + 1;
            // $formatted_villa_count = str_pad($sub_location_villa_count, 3, '0', STR_PAD_LEFT);

            $villa_codes = Villas::where('location_id', $request->location_id)
            ->where('id', '!=', $id)
            ->pluck('code')->toArray();
            $counters = [];

            foreach($villa_codes as $villa_code) {
                $counters[] = substr($villa_code, -3);
            }

            $current_counter = substr($request->code, -3);
            $current_counter_occurence = array_count_values($counters)[$current_counter] ?? 0;

            if($current_counter_occurence == 0) {
                $current_location_id = Villas::find($id)->location_id;

                if($current_location_id != $request->location_id) {
                    $last_count = max($counters) + 1;
                    $formatted_villa_count = str_pad($last_count, 3, '0', STR_PAD_LEFT);
                }else {
                    $formatted_villa_count = $current_counter;
                }
            }else {
                $last_count = max($counters) + 1;
                $formatted_villa_count = str_pad($last_count, 3, '0', STR_PAD_LEFT);
            }
    
            $code = $location->name . '-' . $bedroom . $bathroom . $formatted_villa_count;
        }
        // else {
        //     $bedroom = $request->bedroom ?? 0;
        //     $bathroom = $request->bathroom ?? 0;
        //     $code = $request->code;

        //     $last_3_digits = substr($code, -3);
        //     $current_sub_location = explode('-', $code)[0];
        //     $code = $current_sub_location . '-' . $bedroom . $bathroom . $last_3_digits;

        //     if(!empty($request->sub_location_id)) {
        //         $sub_location = SubLocation::find($request->sub_location_id);
        //         $code = str_replace($current_sub_location, $sub_location->name, $code);
        //     }
        // }

        $object = array(
            'name' => $request->name,
            'type_accomodation' => $request->type_accomodation,
            'privacy_type' => $request->privacy_type,
            'guest' => $request->guest,
            'bedroom' => $request->bedroom,
            'bed' => $request->bed,
            'bathroom' => $request->bathroom,
            'staff' => $request->staff,
            'landsize' => $request->landsize,
            'buildingsize' => $request->buildingsize,
            'yearbuilt' => $request->yearbuilt,
            'last_renovation' => $request->last_renovation,
            'pets' => $request->pets,
            'wheelchair_friendly' => $request->wheelchair_friendly,
            'internet' => $request->internet,
            'code' => $code,
            'short' => $request->short,
            'long' => $request->long,
            'old_link' => $request->old_link,
            'new_link' => $request->new_link,
            'airbnb_link' => $request->airbnb_link,
            'bookingcom_link' => $request->bookingcom_link,
            'base_rate' => $request->base_rate,
            'base_rate_currency' => $request->base_rate_currency,
            'security_cctv' => $request->security_cctv,
            'security_night' => $request->security_night,
            'security_day' => $request->security_day,
            'country_id' => $request->country_id,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id,
            'sub_location_id' => $request->sub_location_id,
            'address' => $request->address,
            'link_map' => $request->link_map,
            'extra_guest_charge' => $request->extra_guest_charge,
            'max_guests' => $request->max_guests,
            'cor_lat' => $request->cor_lat,
            'cor_long' => $request->cor_long,
            'status' => $statusPost,
            // 'link_ical' => $request->link_ical,
            'villa_bvp' => $request->villa_bvp,
        );

        $villa = Villas::findOrFail($id);
        if ($request->hasfile('image_edit')) {
            $images = $request->file('image_edit');
            foreach ($images as $key => $image) {
                if ($image->isValid()) {
                    $image = Storage::disk('uploads')->put('galeri_villa', $image);
                    $galery = GaleriVilla::findOrFail($key);
                    $object_gal['image'] = $image;
                    if ($galery->image) {
                        File::delete('./uploads/' . $galery->image);
                    }
                    $galery->update($object_gal);
                }
                $edit_image[$key] = $key;
            }
        }

        $current = Villas::findOrFail($id);
        $current->facilities()->sync($request->faciliti);
        $current->services()->sync($request->service);

        $villa->update($object);
        // dd($villa->toArray());

        if ($request->file('image') != null) {
            foreach ($request->file('image') as $key => $value) {
                $image = Storage::disk('uploads')->put('galeri_villa', $value);
                $input['image'] = $image;
                $input['title'] = $key;
                $input['villa_id'] = $villa->id;
                GaleriVilla::create($input);
            }
        }

        // EDIT BEDROOM -> BATHROOM //
        if (
            $request->number_of_bedroom_edit ||
            $request->type_of_bedroom_edit ||
            $request->people_can_stay_per_room_edit != null
           
        ) {
            foreach ($request->number_of_bedroom_edit as $key => $value) {
                $data_bedroom = [
                    'number_of_bedrooms' => $request->number_of_bedroom_edit[$key],
                    'type_of_bedroom' => $request->type_of_bedroom_edit[$key],
                    'people_can_stay_per_room' => $request->people_can_stay_per_room_edit[$key],
                    
                    'id_villa' => $id, // Replace with the appropriate villa ID
                ];
                $idBedroomEdit[] = $key;
                $sukses[] = bedroom::where('id', [$key])->update($data_bedroom);
            }
        }

        if (
            $request->type_of_bathroom_edit  != null
        ) {
            foreach ($request->type_of_bathroom_edit as $key_bath => $value) {
                $data_bathroom = [
                    'type_of_bathroom' => $request->type_of_bathroom_edit[$key_bath],
                    'id_villa' => $id, // Replace with the appropriate villa ID
                ];
                $data1[] = $data_bathroom;
                $sukses1[] = Bathroom::where('id_bedroom', [$idBedroomEdit])->update($data_bathroom);
            }
        }
        /* POST BEDROOM */
        if (
            $request->number_of_bedroom &&
            $request->type_of_bedroom &&
            $request->people_can_stay_per_room != null
            
        ) {
            // return $request->number_of_bedroom;
            foreach ($request->number_of_bedroom as $key => $value) {
                $data_bedroom[$key] = [
                    'number_of_bedrooms' => $request->number_of_bedroom[$key],
                    'type_of_bedroom' => $request->type_of_bedroom[$key],
                    'people_can_stay_per_room' => $request->people_can_stay_per_room[$key],
                    'id_villa' => $id, // Replace with the appropriate villa ID
                ];
                $idBedroom = bedroom::insertGetId($data_bedroom[$key]);
                $data_bathroom[$key] = [
                    'type_of_bathroom' => $request->type_of_bathroom[$key],
                    'id_bedroom' => $idBedroom,
                    'id_villa' => $id, // Replace with the appropriate villa ID
                ];
                // $getIdBedroom[] = $idBedroom;
                $bathroom_data = Bathroom::create($data_bathroom[$key]);
            }
            // dd($data_bathroom);

            // foreach ($getIdBedroom as $key => $value) {
            //     $bathroomData[] = $data_bathroom;
            // }
        }

        // EDIT Album GALERI //  
        if ($request->nama_album || $request->deskripsi_album  != null) {
            foreach ($request->nama_album as $key => $value) {
                $input_album['nama'] = $request->nama_album[$key];
                $input_album['deskripsi'] = $request->deskripsi_album[$key];
                $input_album['thumbnail'] = 0;
                $input_album['id_villa'] = $id;
                $input_album['album_category_id'] = $request->album_category[$key];
                
                $album_id = Album::insertGetId($input_album);
                if ($request->image_album != null) {
                    foreach ($request->image_album[$key] as $index => $image) {
                        $image = Storage::disk('uploads')->put('galeri_album', $image);
                        $galery_album['album_id'] = $album_id;
                        $galery_album['villa_id'] = $id;
                        $galery_album['title'] = $request->title_album[$key][$index];
                        $galery_album['image'] = $image;
                        $galery_album['order_number'] = $request->order_number[$key][$index];

                        Galeri::insert($galery_album);
                    }
                }
            }
        }

        if (
            $request->nama_album_edit || $request->deskripsi_album_edit != null
        ) {
            foreach ($request->nama_album_edit as $key => $value) {
                $album = [
                    'nama' => $request->nama_album_edit[$key],
                    'deskripsi' => $request->deskripsi_album_edit[$key],
                    'thumbnail' => 0,
                    'id_villa' => $id,
                    'album_category_id' => $request->album_category[$key],
                ];
                $sukses = Album::where('id', $key)->update($album);

                if ($request->hasfile('image_album_edit')) {
                    $images = $request->file('image_album_edit');
                    foreach ($images as $keyEdit => $image) {
                        if ($image->isValid()) {
                            $galery = Galeri::findOrFail($keyEdit);
                            
                            if ($galery->image) {
                                File::delete('./uploads/' . $galery->image);
                            }

                            $image = Storage::disk('uploads')->put('galeri_album', $image);
                            $object['image'] = $image;
                            $object['title'] = $request->title_album_edit[$keyEdit];
                            $object['order_number'] = $request->order_number_edit[$keyEdit];

                            $galery->update($object);
                        }
                        $edit_image[$keyEdit] = $keyEdit;
                    }
                }else if(!empty($request->galeri_album_edit)) {
                    foreach ($request->galeri_album_edit as $keyEdit => $galeri) {
                        $galery = Galeri::findOrFail($keyEdit);
                        $object['title'] = $request->title_album_edit[$keyEdit];
                        $object['order_number'] = $request->order_number_edit[$keyEdit];

                        $galery->update($object);
                    }
                }
                
                if ($request->hasfile('image_album.' . $key)) {
                    foreach ($request->file('image_album.' . $key) as $keyNew => $value) {
                        $image = Storage::disk('uploads')->put('galeri_album', $value);
                        $dataAlbum = new Galeri([
                            'album_id' => $key,
                            'villa_id' => $id,
                            'title' => $request->title_album[$key][$keyNew],
                            'image' =>  $image,
                            'order_number' => $request->order_number[$key][$keyNew],
                        ]);
                        $dataAlbum->save();
                    }
                }
            }
        }

        if (empty($request->pool_id)) {
            $data_pool = [
                'pool' => $request->pool,
                'type' => $request->type,
                'size_of_pool' => $request->size_of_pool,
                'id_villa' => $id,
            ];
            Pool::insert($data_pool);
        }else {
            $data_pool = [
                'pool' => $request->pool_edit,
                'type' => $request->type_edit,
                'size_of_pool' => $request->size_of_pool_edit,
                'id_villa' => $id,
            ];
            Pool::where('id', $request->pool_id)->update($data_pool);
        }

        /* FLOORPLAN EDIT AND ADD */
        if ($request->nama_floorplan != null || $request->deskripsi != null) {
            $data_floorplan = [
                'nama' => $request->nama_floorplan,
                'deskripsi' => $request->deskripsi,
                'id_villa' => $id,
            ];
            $idAlbumFloorplan = Floorplan::insertGetId($data_floorplan);
        if ($request->hasfile('image_floorplan')) {
            foreach ($request->file('image_floorplan') as $key => $value) {
                $image = Storage::disk('uploads')->put('galeri_floorplan',$value);
                $input['gambar'] = $image;
                $input['deskripsi'] = $request->deskripsi_floorplan[$key];
                $input['id_floorplan'] = $idAlbumFloorplan;
                $input['id_villa'] = $id;
                GambarFloorplan::create($input);
            }
        }
    }
    if ($request->nama_floorplan_edit != null || $request->deskripsi_edit != null) {
        $data_floorplan = [
            'nama' => $request->nama_floorplan_edit,
            'deskripsi' => $request->deskripsi_edit,
            'id_villa' => $id,
        ];
        // Update data floorplan berdasarkan floorplan_id
        Floorplan::where('id', $request->floorplan_id)->update($data_floorplan);
    
        if ($request->hasfile('image_floorplan_edit')) {
            $images = $request->file('image_floorplan_edit');
            foreach ($images as $key => $image) {
                if ($image->isValid()) {
                    // Simpan gambar ke storage
                    $image = Storage::disk('uploads')->put('galeri_floorplan', $image);
    
                    // Persiapkan data untuk GambarFloorplan baru atau update
                    $object_gal = [
                        'gambar' => $image,
                        'deskripsi' => $request->deskripsi_floorplan_edit[$key],
                    ];
    
                    // Ambil atau buat record GambarFloorplan sesuai $key (id)
                    $gallery = GambarFloorplan::findOrNew($key);
                    $gallery->fill($object_gal);
                    $gallery->id_floorplan = $request->floorplan_id; // Hubungkan dengan floorplan yang benar
                    $gallery->id_villa = $id;
                    
    
                    // Hapus gambar lama jika ada
                    if ($gallery->gambar && Storage::disk('uploads')->exists($gallery->gambar)) {
                        Storage::disk('uploads')->delete($gallery->gambar);
                    }
                } else { }
                $edit_image[$key] = $key;
                $a[] = $key;
            }
            // dd($a);
        }
        if ($request->hasfile('new_image_floorplan')) {
            foreach ($request->file('new_image_floorplan') as $key => $image) {
                if ($image->isValid()) {
                    $imagePath = Storage::disk('uploads')->put('galeri_floorplan', $image);
    
                    $newGalleryData = [
                        'gambar' => $imagePath,
                        'deskripsi' => $request->new_deskripsi_floorplan[$key],
                        'id_floorplan' => $request->floorplan_id,
                        'id_villa' => $id,
                    ];
    
                    GambarFloorplan::create($newGalleryData);
                }
            }
        }
    }

        // INCLUSIONS EDIT AND ADD
        if (empty($request->inclusions_id)) {
            $data_inclusions = [
                'breakfast' => $request->breakfast,
                'breakfast_description' => $request->breakfast_description,
                'airport' => $request->airport,
                'airport_description' => $request->airport_description,
                'pijet' => $request->pijet,
                'pijet_description' => $request->pijet_description,
                'anything_else' => $request->anything_else,
                'anything_else_description' => $request->anything_else_description,
                'id_villa' => $id,
            ];
            Inclusions::insert($data_inclusions);
        }else {
            $data_inclusions = [
                'breakfast' => $request->breakfast_edit,
                'breakfast_description' => $request->breakfast_description_edit,
                'airport' => $request->airport_edit,
                'airport_description' => $request->airport_description_edit,
                'pijet' => $request->pijet_edit,
                'pijet_description' => $request->pijet_description_edit,
                'anything_else' => $request->anything_else_edit,
                'anything_else_description' => $request->anything_else_description_edit,
                'id_villa' => $id,
            ];
            Inclusions::where('id', $request->inclusions_id)->update($data_inclusions);
        }

        /* RETREATS EDUT AND ADD */
        if (
            $request->workout_deck &&
            $request->house_chef &&
            $request->exlusive_rental &&
            $request->views_from_workout &&
            $request->gym != null
        ) {
            $data_retreats = [
                'workout_deck' => $request->workout_deck,
                'house_chef' => $request->house_chef,
                'exclusive_rental' => $request->exlusive_rental,
                'views_from_workout' => $request->views_from_workout,
                'gym' => $request->gym,
                'id_villa' => $id,
            ];
            Retreats::insert($data_retreats);
        }
        if (
            $request->workout_deck_edit ||
            $request->house_chef_edit ||
            $request->exlusive_rental_edit ||
            $request->views_from_workout_edit ||
            $request->gym_edit_edit != null
        ) {
            $data_retreats = [
                'workout_deck' => $request->workout_deck_edit,
                'house_chef' => $request->house_chef_edit,
                'exclusive_rental' => $request->exlusive_rental_edit,
                'views_from_workout' => $request->views_from_workout_edit,
                'gym' => $request->gym_edit,
                'id_villa' => $id,
            ];
            Retreats::where('id', $request->retreats_id)->update($data_retreats);
        }

        /* UPDATE WEDDING VILLA */
        if (
            $request->standing_guests &&
            $request->seated_guests &&
            $request->addtional_function_fee &&
            $request->banjar_fee &&
            $request->security_deposit &&
            $request->music_curfew &&
            $request->other_information &&
            $request->wedding_packages_information &&
            $request->wedding_packages != null
        ) {
            $data_wedding_villa = [
                'standing_guests' => $request->standing_guests,
                'seated_guests' => $request->seated_guests,
                'additional_function_fee' => $request->addtional_function_fee,
                'banjar_fee' => $request->banjar_fee,
                'security_deposit' => $request->security_deposit,
                'music_curfew' => $request->music_curfew,
                'other_informasion' => $request->other_informasion,
                'wedding_packages' => $request->wedding_packages,
                'wedding_packages_information' => $request->wedding_packages_information,
                'id_villa' => $id,
            ];
            WeddingVilla::insert($data_wedding_villa);
        }
        if (
            $request->standing_guests_edit ||
            $request->seated_guests_edit ||
            $request->addtional_function_fee_edit ||
            $request->banjar_fee_edit ||
            $request->security_deposit_edit ||
            $request->music_curfew_edit ||
            $request->other_information_edit ||
            $request->wedding_packages_information_edit ||
            $request->wedding_packages_edit != null
        ) {
            $data_wedding_villa = [
                'standing_guests' => $request->standing_guests_edit,
                'seated_guests' => $request->seated_guests_edit,
                'additional_function_fee' => $request->addtional_function_fee_edit,
                'banjar_fee' => $request->banjar_fee_edit,
                'security_deposit' => $request->security_deposit_edit,
                'music_curfew' => $request->music_curfew_edit,
                'other_informasion' => $request->other_informasion_edit,
                'wedding_packages' => $request->wedding_packages_edit,
                'wedding_packages_information' => $request->wedding_packages_information_edit,
                'id_villa' => $id,
            ];
            WeddingVilla::where('id', $request->wedding_id)->update($data_wedding_villa);
        }

        /* MOINTAIN EDIT AND ADD */
        if (
            $request->mountain_view &&
            $request->view_of_ricefield &&
            $request->river_closeby &&
            $request->waterfall_closeby &&
            $request->activities &&
            $request->track_information &&
            $request->birdwatching &&
            $request->guide != null
        ) {
            $data_mountain = [
                'mountain_view' => $request->mountain_view,
                'view_of_ricefield' => $request->view_of_ricefield,
                'river_closeby' => $request->river_closeby,
                'waterfall_closeby' => $request->waterfall_closeby,
                'activities' => $request->activities,
                'track_information' => $request->track_information,
                'birdwatching' => $request->birdwatching,
                'guide' => $request->guide,
                'id_villa' => $id,
            ];
            MountainVilla::insert($data_mountain);
        }
        if (
            $request->mountain_view_edit ||
            $request->view_of_ricefield_edit ||
            $request->river_closeby_edit ||
            $request->waterfall_closeby_edit ||
            $request->activities_edit ||
            $request->track_information_edit ||
            $request->birdwatching_edit ||
            $request->guide_edit != null
        ) {
            $data_mountain = [
                'mountain_view' => $request->mountain_view_edit,
                'view_of_ricefield' => $request->view_of_ricefield_edit,
                'river_closeby' => $request->river_closeby_edit,
                'waterfall_closeby' => $request->waterfall_closeby_edit,
                'activities' => $request->activities_edit,
                'track_information' => $request->track_information_edit,
                'birdwatching' => $request->birdwatching_edit,
                'guide' => $request->guide_edit,
                'id_villa' => $id,
            ];
            MountainVilla::where('id', $request->mountain_id)->update($data_mountain);
        }

        if (
            $request->club_name &&
            $request->type_of_club &&
            $request->good_days != null
        ) {
            $data_close_the_clubs = [
                'club_name' => $request->club_name,
                'type_of_club' => $request->type_of_club,
                'good_days' => $request->good_days,
                'id_villa' => $id,
            ];
            CloseToTheClubs::insert($data_close_the_clubs);
        }
        if (
            $request->club_name_edit ||
            $request->type_of_club_edit ||
            $request->good_days_edit != null
        ) {
            $data_close_the_clubs = [
                'club_name' => $request->club_name_edit,
                'type_of_club' => $request->type_of_club_edit,
                'good_days' => $request->good_days_edit,
                'id_villa' => $id,
            ];
            CloseToTheClubs::where('id', $request->close_clubs_id)->update($data_close_the_clubs);
        }


        if (
            $request->pool_fence &&
            $request->baby_cot &&
            $request->infant_cot &&
            $request->baby_high_chair &&
            $request->chef_family_villa &&
            $request->costs_for_chef &&
            $request->nanny_cost &&
            $request->included != null
        ) {
            $data_family_villa = [
                'pool_fence' => $request->pool_fence,
                'baby_cot' => $request->baby_cot,
                'infant_cot' => $request->infant_cot,
                'baby_high_chair' => $request->baby_high_chair,
                'chef' => $request->chef_family_villa,
                'costs_for_chef' => $request->costs_for_chef,
                'nanny_cost' => $request->nanny_cost,
                'included' => $request->included,
                'photos' => $request->photos,
                'id_villa' => $id,
            ];
            if ($request->has('photos')) {
                $photos = Storage::disk('uploads')->put('familly_villa', $request->photos);
                $data_family_villa['photos'] = $photos;
            }
            FamilyVilla::insert($data_family_villa);
        }
        if (
            $request->pool_fence_edit ||
            $request->baby_cot_edit ||
            $request->infant_cot_edit ||
            $request->baby_high_chair_edit ||
            $request->chef_family_villa_edit ||
            $request->costs_for_chef_edit ||
            $request->nanny_cost_edit ||
            $request->included_edit != null
        ) {
            $data_family_villa = [
                'pool_fence' => $request->pool_fence_edit,
                'baby_cot' => $request->baby_cot_edit,
                'infant_cot' => $request->infant_cot_edit,
                'baby_high_chair' => $request->baby_high_chair_edit,
                'chef' => $request->chef_family_villa_edit,
                'costs_for_chef' => $request->costs_for_chef_edit,
                'nanny_cost' => $request->nanny_cost_edit,
                'included' => $request->included_edit,
                // 'photos' => $request->photos,
                'id_villa' => $id,
            ];
            $current = FamilyVilla::findOrFail($request->family_id);

            if ($request->has('photos_edit')) {
                $photos = Storage::disk('uploads')->put('familly_villa', $request->photos_edit);
                $data_family_villa['photos'] = $photos;
                if ($current->photos) {
                    File::delete('./uploads/' . $current->photos);
                }
            }
            FamilyVilla::where('id', $request->family_id)->update($data_family_villa);
        }

        if (
            $request->what_beach &&
            $request->how_far_walking &&
            $request->views_of_ocean &&
            $request->surf_villa &&
            $request->waves_nearby &&
            $request->extra_information &&
            $request->other_information != null
        ) {
            $data_beach_villa = [
                'what_beach' => $request->what_beach,
                'how_far_walking' => $request->how_far_walking,
                'views_of_ocean' => $request->views_of_ocean,
                'surf_villa' => $request->surf_villa,
                'waves_nearby' => $request->waves_nearby,
                'extra_information' => $request->extra_information,
                'other_information' => $request->other_information,
                'id_villa' => $id,
            ];
            BeachVilla::insert($data_beach_villa);
        }
        if (
            $request->what_beach_edit ||
            $request->how_far_walking_edit ||
            $request->views_of_ocean_edit ||
            $request->surf_villa_edit ||
            $request->waves_nearby_edit ||
            $request->extra_information_edit ||
            $request->other_information_edit != null
        ) {
            $data_beach_villa = [
                'what_beach' => $request->what_beach_edit,
                'how_far_walking' => $request->how_far_walking_edit,
                'views_of_ocean' => $request->views_of_ocean_edit,
                'surf_villa' => $request->surf_villa_edit,
                'waves_nearby' => $request->waves_nearby_edit,
                'extra_information' => $request->extra_information_edit,
                'other_information' => $request->other_information_edit,
                'id_villa' => $id,
            ];
            BeachVilla::where('id', $request->beach_id)->update($data_beach_villa);
        }

        if (empty($request->staff_id)) {
            $data_staf_villa = [
                'house_keeper' => $request->house_keeper,
                'satpam' => $request->satpam,
                'manager' => $request->manager,
                'chef' => $request->chef_staff,
                'gardener' => $request->gardener,
                'driver' => $request->driver,
                'other' => $request->other,
                'id_villa' => $id,
            ];
            StaffAtVilla::insert($data_staf_villa);
        }else {
            $data_staf_villa = [
                'house_keeper' => $request->house_keeper_edit,
                'satpam' => $request->satpam_edit,
                'manager' => $request->manager_edit,
                'chef' => $request->chef_staff_edit,
                'gardener' => $request->gardener_edit,
                'driver' => $request->driver_edit,
                'other' => $request->other_edit,
                'id_villa' => $id,
            ];
            StaffAtVilla::where('id', $request->staff_id)->update($data_staf_villa);
        }

        if (empty($request->chef_id)) {
            $data_chef = [
                'chef' => $request->chef,
                'cost' => $request->cost,
                'chef_cost_currency' => $request->chef_cost_currency,
                'information' => $request->information,
                'id_villa' => $id,
            ];
            Chef::insert($data_chef);
        }else {
            $data_chef = [
                'chef' => $request->chef_edit,
                'cost' => $request->cost_edit,
                'chef_cost_currency' => $request->chef_cost_currency_edit,
                'information' => $request->information_edit,
                'id_villa' => $id,
            ];
            Chef::where('id', $request->chef_id)->update($data_chef);
        }

        if (empty($request->car_id)) {
            $data_car = [
                'system_for_use' => $request->system_for_use,
                'car_currency' => $request->car_currency,
                'cost' => $request->cost_driver,
                'information' => $request->information_car,
                'id_villa' => $id,
            ];
            // dd($data_car);
            CarAndDrive::insert($data_car);
        }else {
            $data_car = [
                'system_for_use' => $request->system_for_use_edit,
                'car_currency' => $request->car_currency_edit,
                'cost' => $request->cost_driver_edit,
                'information' => $request->information_car_edit,
                'id_villa' => $id,
            ];
            CarAndDrive::where('id', $request->car_id)->update($data_car);
        }

        // UPDATE PRICING
        if (empty($request->pricing_id)) {
            $pricing = [
                'monthly_rental' => $request->monthly_rental,
                'monthly_description' => $request->monthly_description,
                'yearly_rental' => $request->yearly_rental,
                'yearly_description' => $request->yearly_description,
                'available_for_sales_rental' => $request->available_for_sales,
                'available_for_sales_description' => $request->available_for_sales_description,
                'long_term_rental' => $request->long_term_rental,
                'long_term_sales' => $request->long_term_sales,
                'freehold' => $request->freehold,
                'freehold_description' => $request->freehold_description,
                'leasehold' => $request->leasehold,
                'leasehold_description' => $request->leasehold_description,
                'id_villa' => $id,
                'monthly_currency' => $request->monthly_currency,
                'monthly_cost' => $request->monthly_cost,
                'yearly_currency' => $request->yearly_currency,
                'yearly_cost' => $request->yearly_cost,
                'available_for_sales_currency' => $request->available_for_sales_currency,
                'available_for_sales_cost' => $request->available_for_sales_cost,
                'long_term_rental_currency' => $request->long_term_rental_currency,
                'long_term_rental_cost' => $request->long_term_rental_cost,
                'freehold_currency' => $request->freehold_currency,
                'freehold_cost' => $request->freehold_cost,
                'leasehold_currency' => $request->leasehold_currency,
                'leasehold_cost' => $request->leasehold_cost,
                'leasehold_available_until' => $request->leasehold_available_until,
            ];
            Pricing::insert($pricing);
        }else {
            $pricing = [
                'monthly_rental' => $request->monthly_rental_edit,
                'monthly_description' => $request->monthly_description_edit,
                'yearly_rental' => $request->yearly_rental_edit,
                'yearly_description' => $request->yearly_description_edit,
                'available_for_sales_rental' => $request->available_for_sales_edit,
                'available_for_sales_description' => $request->available_for_sales_description_edit,
                'long_term_rental' => $request->long_term_rental_edit,
                'long_term_sales' => $request->long_term_sales_edit,
                'freehold' => $request->freehold_edit,
                'freehold_description' => $request->freehold_description_edit,
                'leasehold' => $request->leasehold_edit,
                'leasehold_description' => $request->leasehold_description_edit,
                'id_villa' => $id,
                'monthly_currency' => $request->monthly_currency,
                'monthly_cost' => $request->monthly_cost,
                'yearly_currency' => $request->yearly_currency,
                'yearly_cost' => $request->yearly_cost,
                'available_for_sales_currency' => $request->available_for_sales_currency,
                'available_for_sales_cost' => $request->available_for_sales_cost,
                'long_term_rental_currency' => $request->long_term_rental_currency,
                'long_term_rental_cost' => $request->long_term_rental_cost,
                'freehold_currency' => $request->freehold_currency,
                'freehold_cost' => $request->freehold_cost,
                'leasehold_currency' => $request->leasehold_currency,
                'leasehold_cost' => $request->leasehold_cost,
                'leasehold_available_until' => $request->leasehold_available_until,
            ];
            Pricing::where('id', $request->pricing_id)->update($pricing);
        }

        return redirect()->route('admin.villa.edit', $id)
            ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Villas  $villas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Villas $villas, $id)
    {
        //
        $villa = Villas::where('id', $id)->firstOrFail();
        $galeri = GaleriVilla::where('villa_id', $id)->get();

        foreach ($galeri as $key => $value) {;
            File::delete('./uploads/' . $value->image);
        }
        DB::table('facilities_villas')->where('villa_id', $id)->delete();
        DB::table('galeri_villas')->where('villa_id', $id)->delete();
        $villa->delete();
        return redirect()->route('admin.villa.index')
            ->with(['notif_status' => '1', 'notif' => 'Delete data succeed.']);
    }

    /* RATE */
    public function create_rate($id)
    {
        //
        $villa = Villas::find($id);
        // dd($villa->toArray());
        $data["page_title"] = 'Tambah Rate';
        $data['villa'] = $villa;
        return view('admin.villa.form_rate', $data);
    }
    public function store_rate(
        StoreRateService $storeRateService,
        UpdateRateService $updateRateService,
        Request $request,
        $id
    ) {
        //
        // dd('rates');

        // $rules = array(
        //     'details' => 'required',
        //     'type' => 'required',
        //     'price' => 'required',
        //     'start_date' => 'required',
        //     'end_date' => 'required',
        // );

        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',

        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $object = array(
        //     'villa_id' => $id,
        //     'name' => $request->name,
        //     'type' => $request->type,
        //     'start_date' => $request->start_date,
        //     'end_date' => $request->end_date,
        //     'price' => $request->price,
        // );

        // // dd($object);
        // Rates::create($object);

        $rates = json_decode($request->ratesJson);

        if($rates->edit) {
            $updateRateService->execute([
                'rate_id' => $rates->rate_id,
                'villa_id' => $id,
                'details' => $rates->details,
                'type' => $rates->type,
                'start_date' => $rates->start_date,
                'end_date' => $rates->end_date,
                'rooms' => $rates->rooms,
            ]);
        }else {
            $storeRateService->execute([
                'villa_id' => $id,
                'details' => $rates->details,
                'type' => $rates->type,
                'start_date' => $rates->start_date,
                'end_date' => $rates->end_date,
                'rooms' => $rates->rooms,
            ]);
        }

        return redirect()->route('admin.villa.edit', ['id' => $id])
            ->with(['notif_status' => '1', 'notif' => 'Insert data rate succeed.']);
    }
    public function edit_rate(
        GetRateService $getRateService,
        $id
    ) {
        //
        // $rate = Rates::find($id);
        // // dd($rate);
        // $villa = Villas::find($rate->villa_id);
        // $data['page_title'] = 'Update Rate';
        // $data['edit_mode'] = true;
        // $data['villa'] = $villa;
        // $data['start_date'] = date('Y-m-d', strtotime($rate->start_date));
        // $data['end_date'] = date('Y-m-d', strtotime($rate->end_date));
        // $data['rate'] = $rate;
        $rate = $getRateService->execute([
            'rate_id' => $id,
        ])->data;

        $data = [
            'id' => $rate->id,
            'villa_id' => $rate->villa_id,
            'details' => $rate->details,
            'type' => $rate->type,
            'start_date' => Carbon::parse($rate->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($rate->end_date)->format('Y-m-d'),
            'rooms' => $rate->rooms,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Rate retrieved successfully',
        ]);
    }
    public function update_rate(Request $request, $id)
    {
        //
        // dd('update');
        $rules = array(
            // 'villa_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'price' => 'required',
        );
        // dd($rules);
        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Update data rate failed.'])
                ->withInput();
        }
        $object = array(
            // 'villa_id' => $rate->villa_id,
            'name' => $request->name,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $request->price,
        );
        // dd($object);

        $rate = Rates::findOrFail($id);
        $rate->update($object);
        return redirect()->route('admin.villa.edit', ['id' => $rate->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Update data rate succeed.']);
    }

    public function destroy_rate($id)
    {
        //
        $rate = Rates::where('id', $id)->firstOrFail();
        $rate->delete();
        return redirect()->route('admin.villa.edit', ['id' => $rate->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Delete data rate succeed.']);
    }

    /* FACILITY */
    public function create_facility($id)
    {
        //

        $facility = Facilities::all();
        $villa = Villas::find($id);

        $cek = Facilities_villas::where('villa_id', $id)->get();
        // dd($cek->toArray());
        if (sizeof($cek)) {
            $data['edit_mode'] = true;
            $checked = Facilities_villas::where('villa_id', $id)->get();
            $data['checked'] = $checked;
        } else {
            $data['edit_mode'] = false;
        }

        // dd($data['edit_mode']);

        // dd($villa->toArray());
        $data["page_title"] = 'Tambah Facility Villa';
        $data['facility'] = $facility;
        $data['villa'] = $villa;
        return view('admin.villa.form_facility', $data);
    }

    public function store_facility(Request $request, $id)
    {
        //
        // $input = $request->facility_id;
        $villa = Villas::find($id);
        // dd($villa->id);
        $rules = array(
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

        foreach ($request->facility_id as $key => $value) {
            $input['villa_id'] = $villa->id;
            $input['facility_id'] = $value;
            // dd($input);
            Facilities_villas::create($input);
        }

        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert data facility succeed.']);
    }

    public function edit_facility($id)
    {
        //
        $villa = Villas::find($id);
        $facility = Facilities::all();
        $checked = Facilities_villas::where('villa_id', $id)->get();
        // dd($checked->toArray());
        $data['page_title'] = 'Update Facility Villas';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        $data['facility'] = $facility;
        $data['checked'] = $checked;
        return view('admin.villa.form_facility', $data);
    }

    public function update_facility(Request $request, $id)
    {
        //
        // dd($id);
        $villa = Villas::find($id);
        $rules = array(
            'facility_id' => 'required',
        );
        // dd($rules);
        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'update data facility failed.'])
                ->withInput();
        }
        DB::table('facilities_villas')->where('villa_id', $id)->delete();
        // dd('yuda');

        foreach ($request->facility_id as $key => $value) {
            $input['villa_id'] = $villa->id;
            $input['facility_id'] = $value;
            // dd($input);
            Facilities_villas::create($input);
        }

        // $facil = Facilities_villas::findOrFail($id);
        // $facil->update($object);
        return redirect()->route('admin.villa.edit', ['id' => $villa->id])
            ->with(['notif_status' => '1', 'notif' => 'Update data facility succeed.']);
    }

    public function destroy_facility($id)
    {
        //
        $facilities = Facilities_villas::where('id', $id)->firstOrFail();
        $facilities->delete();
        return redirect()->route('admin.villa.edit', ['id' => $facilities->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Delete data facility succeed.']);
    }

    /* Galllery */
    public function edit_galeri($id)
    {
        //
        $galeri = GaleriVilla::find($id);
        // dd($checked->toArray());
        $data['galeri'] = $galeri;
        return response()->json($data);
    }

    public function update_galeri(Request $request, $id)
    {
        //
        // dd($id);
        $current = GaleriVilla::findOrFail($id);

        $object = array(
            'villa_id' => $current->villa_id,
            'title' => $current->title,
        );

        // dd($request->all());

        if ($request->has('image')) {
            $image = Storage::disk('uploads')->put('galeri_villa', $request->image);
            $object['image'] = $image;
            // dd($object['avatar']);
            if ($current->image) {
                File::delete('./uploads/' . $current->image);
            }
        }

        // $facil = Facilities_villas::findOrFail($id);
        $current->update($object);
        return redirect()->route('admin.villa.edit', ['id' => $current->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Update data galeri succeed.']);
    }

    public function destroy_galeri($id)
    {
        //
        // dd($id);
        $galeri = GaleriVilla::where('id', $id)->firstOrFail();
        File::delete('./uploads/' . $galeri->image);
        $galeri->delete();
        return redirect()->route('admin.villa.edit', ['id' => $galeri->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Delete data galeri villa succeed.']);
    }

    public function destroy_floorplan($id)
    {
        //
        $galeri = GambarFloorplan::where('id', $id)->firstOrFail();
        // dd($galeri->toArray());
        File::delete('./uploads/' . $galeri->image);
        $galeri->delete();
        return redirect()->route('admin.villa.edit', ['id' => $galeri->id_villa])
            ->with(['notif_status' => '1', 'notif' => 'Delete data gambar floorplan succeed.']);
    }

    public function destroy_bedroom($id)
    {
        //
        // dd($id);
        $bathroom = Bathroom::where('id_bedroom', $id)->delete();
        // dd($bathroom);
        $bedroom = bedroom::where('id', $id)->firstOrFail();
        $bedroom->delete();
        return redirect()->route('admin.villa.edit', ['id' => $bedroom->id_villa])
            ->with(['notif_status' => '1', 'notif' => 'Delete data bedroom villa succeed.']);
    }

    public function destroy_album($id)
    {
        //
        $album = Album::where('id', $id)->firstOrFail();
        $galeri = Galeri::where('album_id', $album->id)->get();
        // if($galeri !=)
        if ($galeri->isEmpty() != true) {
            foreach ($galeri as $key => $value) {
                File::delete('./uploads/' . $value->image);
            };
            $galeri = Galeri::where('album_id', $album->id)->delete();
        }
        $album->delete();
        return redirect()->route('admin.villa.edit', ['id' => $album->id_villa])
            ->with(['notif_status' => '1', 'notif' => 'Delete data bedroom villa succeed.']);
    }

    public function destroy_album_galeri($id)
    {
        //
        $galeri = Galeri::where('id', $id)->firstOrFail();
        // dd($galeri->toArray());
        File::delete('./uploads/' . $galeri->image);
        $galeri->delete();
        return redirect()->route('admin.villa.edit', ['id' => $galeri->villa_id])
            ->with(['notif_status' => '1', 'notif' => 'Delete data galeri villa succeed.']);
    }

    public function search_villa(
        Request $request,
        GetVillaService $getVillaService
    ) {   
        $villas = [];
        // if ($request->has('start_date')) {
        //     dd($request->all());
        //     $rules = array(
        //         'start_date' => 'required',
        //         'end_date' => 'required',
        //     );
        //     // dd($rules);
        //     $validator = Validator::make($request->all(), $rules, $messages = [
        //         'required' => 'The :attribute field is required.',
        //     ]);
        //     # code...
        //     if ($validator->fails()) {
        //         return redirect()->back()
        //             ->withErrors($validator)
        //             ->with(['notif_status' => '0', 'notif' => 'Search Failed'])
        //             ->withInput();
        //     }
        //     $input = $request->all();
        //     // dd($input);
        // }
        // if($request->hasAny(['start_date','area', 'location','sub_location','bedroom'])){
        //     $villas = Villas::with('location','area','sublocation','pricing','facilities')
        //                         ->where('status','post')
        //                         ->where('area_id','like','%'.$request->area.'%')
        //                         ->where('location_id','like','%'.$request->location.'%')
        //                         ->where('sub_location_id','like','%'.$request->sub_location.'%')
        //                         ->where('bedroom','like','%'.$request->bedroom.'%')
        //                         ->where('bathroom','like','%'.$request->bathroom.'%')
        //                             ->whereHas('pricing', function ($q) use ($input) {
        //                                 $q->where('monthly_rental','like','%'.$input['monthly'].'%')
        //                                     ->where('yearly_rental','like','%'.$input['yearly'].'%')
        //                                     ->where('freehold','like','%'.$input['freehold'].'%')
        //                                     ->where('leasehold','like','%'.$input['leasehold'].'%');
        //                             })
        //                         ->get();
        // }else{
        //     $villas = Villas::with('location','area','sublocation','pricing','facilities')
        //                         ->where('status','post')
        //                         ->get();
        // }
        // dd($villas->toArray());
        // $request->merge([
        //     'status' => 'post'
        // ]);
        
        $villas = $getVillaService->execute($request->all())->data;

        $areas = Areas::all();
        $location = Location::where('area_id',$request->area_id)->get();
        $sublocation = SubLocation::where('location_id',$request->location_id)->get();
        $data['areas'] = $areas;
        $data['villas'] = $villas;
        $data['location'] = $location;
        $data['sublocation'] = $sublocation;
        $data['request'] = $request;

        $data["page_title"] = 'Manajemen Search Villa';
        return view('admin.villa.search_villa', $data);
    }
    public function villa_by_location(Request $request)
    {
        //
        // dd($request->all());
        $villa = Villas::where([
            ['country_id', '=', $request->country],
            ['area_id', '=', $request->area],
            ['location_id', '=', $request->location],
            ['sub_location_id', '=', $request->sub_location]
        ])->get();
        $data['villa'] = $villa;
        $data["page_title"] = 'Manajemen Search Villa';
        return view('admin.villa.villa_by_location', $data);
    }
    public function create_beach($id)
    {
        $data["page_title"] = 'Tambah Beach';
        $data["villa"] = Villas::where('id',$id)->with('beach')->firstorfail();
        // dd($data["villa"]->toArray());
        return view('admin.experience.beach', $data);
    }
    public function store_beach(Request $request,$id)
    {
        //  $rules = array(
        //     'what_beach' => 'required',
        //     'how_far_walking' => 'required',
        //     'views_of_ocean' => 'required',
        //     'surf_villa' => 'required',
        //     'waves_nearby' => 'required',
        //     'extra_information' => 'required',
        //     'other_information' => 'required',
        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',

        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $object = [
            'what_beach' => $request->what_beach,
            'how_far_walking' => $request->how_far_walking,
            'views_of_ocean' => $request->views_of_ocean,
            'surf_villa' => $request->surf_villa,
            'waves_nearby' => $request->waves_nearby,
            'extra_information' => $request->extra_information,
            'other_information' => $request->other_information,
            'id_villa' => $id,
            'beachfront' => $request->beachfront,
            'other' => $request->other,
        ];
        BeachVilla::create($object);
        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_beach($id)
    {
        $villa = Villas::where('id',$id)->with('beach')->firstorfail();
        $data['page_title'] = 'Update Beach';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        return view('admin.experience.beach', $data);
    }
    public function update_beach(Request $request, $id)
    {
        //
        // $rules = array(
        //     'what_beach' => 'required',
        //     'how_far_walking' => 'required',
        //     'views_of_ocean' => 'required',
        //     'surf_villa' => 'required',
        //     'waves_nearby' => 'required',
        //     'extra_information' => 'required',
        //     'other_information' => 'required',
        // );
        // $validator = Validator::make($request->all(), $rules, $messages = [
        //         'required' => 'The :attribute field is required.',
        //         'file' => 'The :attribute must be a file.',
        //     ]);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
        //         ->withInput();
        // }
        $object = array(
            'what_beach' => $request->what_beach,
            'how_far_walking' => $request->how_far_walking,
            'views_of_ocean' => $request->views_of_ocean,
            'surf_villa' => $request->surf_villa,
            'waves_nearby' => $request->waves_nearby,
            'extra_information' => $request->extra_information,
            'other_information' => $request->other_information,
            'beachfront' => $request->beachfront,
            'other' => $request->other,
        );


        $villa = Villas::where('id',$id)->with('beach')->firstorfail();
        $current = BeachVilla::findOrFail($villa->beach->id);

        $current->update($object); 

        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    public function destroy_beach($id)
    {
        $beach = BeachVilla::where('id', $id)->firstOrFail();
        $beach->delete();
        return redirect()->route('admin.villa.edit', ['id' => $beach->id_villa])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed beach.']); 
    }
    public function create_close($id)
    {
        $data["page_title"] = 'Tambah Close to the clubs';
        $data["villa"] = Villas::where('id',$id)->with('close_clubs')->firstorfail();
        // dd($data["villa"]->toArray());
        return view('admin.experience.close', $data);
    }
    public function store_close(
        StoreClubService $storeClubService,
        UpdateClubService $updateClubService,
        Request $request,
        $id
    ) {
        //\
        // $rules = array(
        //     'club_name' => 'required',
        //     'type_of_club' => 'required',
        //     'good_days' => 'required',
        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',

        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $object = [
        //     'club_name' => $request->club_name,
        //     'type_of_club' => $request->type_of_club,
        //     'good_days' => $request->good_days,
        //     'id_villa' => $id,
        // ];
        // CloseToTheClubs::create($object);

        $clubs = json_decode($request->clubsJson);

        $existing_club = (new GetClubService)->execute([
            'id_villa' => $id,
        ])->data;

        $delete_club = array_diff($existing_club->pluck('id')->toArray(), array_column($clubs, 'club_id'));
        foreach($delete_club as $club_id) {
            (new DeleteClubService)->execute([
                'club_id' => $club_id,
            ]);
        }

        foreach($clubs as $club) {
            if(empty($club->club_id)) {
                $storeClubService->execute([
                    'id_villa' => $club->id_villa,
                    'club_name' => $club->club_name,
                    'type_of_club' => $club->type_of_club,
                    'good_days' => $club->good_days,
                    'other' => $club->other,
                ]);
            }else {
                $updateClubService->execute([
                    'club_id' => $club->club_id,
                    'id_villa' => $club->id_villa,
                    'club_name' => $club->club_name,
                    'type_of_club' => $club->type_of_club,
                    'good_days' => $club->good_days,
                    'other' => $club->other,
                ]);
            }
        }

        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_close(Facilities $facilities, $id)
    {
        $villa = Villas::where('id',$id)->with('close_clubs')->firstorfail();
        $data['page_title'] = 'Update Close';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        return view('admin.experience.close', $data);
    }
    public function update_close(Request $request, $id)
    {
        //
        $rules = array(
            'club_name' => 'required',
            'type_of_club' => 'required',
            'good_days' => 'required',

        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            'file' => 'The :attribute must be a file.',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = [
            'club_name' => $request->club_name,
            'type_of_club' => $request->type_of_club,
            'good_days' => $request->good_days,

        ];
        $villa = Villas::where('id',$id)->with('close_clubs')->firstorfail();
        $current = CloseToTheClubs::findOrFail($villa->close_clubs->id);

        $current->update($object);

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    public function destroy_close($id)
    {
        $close_clubs = CloseToTheClubs::where('id_villa', $id)->get();
        
        foreach($close_clubs as $club) {
            (new DeleteClubService)->execute([
                'club_id' => $club->id,
            ]);
        }

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed close to the clubs.']);
    }
    public function create_family(
        GetCurrencyService $getCurrencyService,
        $id
    ) {
        $data["page_title"] = 'Tambah Family';
        $data["villa"] = Villas::where('id',$id)->with('family')->firstorfail();
        // dd($data["villa"]->toArray());
        $data['currencies'] = $getCurrencyService->execute()->data;

        return view('admin.experience.family', $data);
    }
    public function store_family(
        StoreFamilyVillaService $storeFamilyVillaService,
        Request $request, $id
    ) {
         //\
        //  $rules = array(
        //     'pool_fence' => 'required',
        //     'baby_cot' => 'required',
        //     'infant_cot' => 'required',
        //     'baby_high_chair' => 'required',
        //     'chef' => 'required',
        //     'costs_for_chef' => 'required',
        //     'nanny_cost' => 'required',
        //     'included' => 'required',
        //     'photos' => 'required|file',
        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',

        // ]);

        // if ($validator->fails()) {
        //     // dd($validator);
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        
        // $object = [
        //     'pool_fence' => $request->pool_fence,
        //     'baby_cot' => $request->baby_cot,
        //     'infant_cot' => $request->infant_cot,
        //     'baby_high_chair' => $request->baby_high_chair,
        //     'chef' => $request->chef,
        //     'costs_for_chef' => $request->costs_for_chef,
        //     'nanny_cost' => $request->nanny_cost,
        //     'included' => $request->included,
        //     'id_villa' => $id,
        // ];
        $photos = null;
        if ($request->has('photos')) {
            $image = Storage::disk('uploads')->put('family', $request->photos);
            $photos = $image;
        }
        // FamilyVilla::create($object);
        $storeFamilyVillaService->execute([
            'id_villa' => $id,
            'pool_fence' => $request->pool_fence,
            'baby_cot' => $request->baby_cot,
            'infant_cot' => $request->infant_cot,
            'baby_high_chair' => $request->baby_high_chair,
            'chef' => $request->chef,
            'costs_for_chef' => $request->costs_for_chef,
            'nanny_cost' => $request->nanny_cost,
            'included' => $request->included,
            'photos' => $photos,
            'costs_for_chef_currency' => $request->costs_for_chef_currency,
            'nanny_cost_currency' => $request->nanny_cost_currency,
            'included_currency' => $request->included_currency,
            'kids_toys' => $request->kids_toys,
            'other' => $request->other,
        ]);

        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_family(
        GetCurrencyService $getCurrencyService,
        Facilities $facilities,
        $id
    ) {
        $villa = Villas::where('id',$id)->with('family')->firstorfail();
        $data['page_title'] = 'Update Family';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        $data['currencies'] = $getCurrencyService->execute()->data;

        return view('admin.experience.family', $data);
    }
    public function update_family(
        UpdateFamilyVillaService $updateFamilyVillaService,
        Request $request,
        $id
    ) {
    
        //
        // $rules = array(
        //     'pool_fence' => 'required',
        //     'baby_cot' => 'required',
        //     'infant_cot' => 'required',
        //     'baby_high_chair' => 'required',
        //     'chef' => 'required',
        //     'costs_for_chef' => 'required',
        //     'nanny_cost' => 'required',
        //     'included' => 'required',
        //     // 'photos' => 'required|file',

        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',

        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
        //         ->withInput();
        // }

        // $object = [
        //     'pool_fence' => $request->pool_fence,
        //     'baby_cot' => $request->baby_cot,
        //     'infant_cot' => $request->infant_cot,
        //     'baby_high_chair' => $request->baby_high_chair,
        //     'chef' => $request->chef,
        //     'costs_for_chef' => $request->costs_for_chef,
        //     'nanny_cost' => $request->nanny_cost,
        //     'included' => $request->included,
            
        // ];
        $villa = Villas::where('id',$id)->with('family')->firstorfail();
        $photos = null;

        if ($request->has('photos')) {
            $family = $villa->family;
            // Hapus foto lama jika ada
            if ($family->photos && Storage::disk('uploads')->exists($family->photos)) {
                Storage::disk('uploads')->delete($family->photos);
            }
            // Simpan foto baru
            $image = Storage::disk('uploads')->put('family', $request->file('photos'));
            $photos = $image;

            // $family->photos = $image;
            // $family->save();
        }

        // $current = FamilyVilla::findOrFail($villa->family->id);

        // $current->update($object);

        $updateFamilyVillaService->execute([
            'family_villa_id' => $villa->family->id,
            'id_villa' => $id,
            'pool_fence' => $request->pool_fence,
            'baby_cot' => $request->baby_cot,
            'infant_cot' => $request->infant_cot,
            'baby_high_chair' => $request->baby_high_chair,
            'chef' => $request->chef,
            'costs_for_chef' => $request->costs_for_chef,
            'nanny_cost' => $request->nanny_cost,
            'included' => $request->included,
            'photos' => $photos,
            'costs_for_chef_currency' => $request->costs_for_chef_currency,
            'nanny_cost_currency' => $request->nanny_cost_currency,
            'included_currency' => $request->included_currency,
            'kids_toys' => $request->kids_toys,
            'other' => $request->other,
        ]);

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    public function destroy_family(Facilities $facilities, $id)
    {
        $family = FamilyVilla::where('id', $id)->firstOrFail();
        $family->delete();
        return redirect()->route('admin.villa.edit', ['id' => $family->id_villa])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed family.']);
    }
    public function create_mountain($id)
    {
        $data["page_title"] = 'Tambah Mountain';
        $data["villa"] = Villas::where('id',$id)->with('mountain')->firstorfail();
        // dd($data["villa"]->toArray());
        return view('admin.experience.mountain', $data);
    }
    public function store_mountain(Request $request, $id)
    {
         //\
         $rules = array(
            'mountain_view' => 'required',
            'view_of_ricefield' => 'required',
            'river_closeby' => 'required',
            'waterfall_closeby' => 'required',
            'activities' => 'required',
            'track_information' => 'required',
            'birdwatching' => 'required',
            'guide' => 'required'
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
        $object = [
            'mountain_view' => $request->mountain_view,
            'view_of_ricefield' => $request->view_of_ricefield,
            'river_closeby' => $request->river_closeby,
            'waterfall_closeby' => $request->waterfall_closeby,
            'activities' => $request->activities,
            'track_information' => $request->track_information,
            'birdwatching' => $request->birdwatching,
            'guide' => $request->guide,
            'id_villa' => $id,
            'other' => $request->other,
        ];
        MountainVilla::create($object);
        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_mountain($id)
    {
        $villa = Villas::where('id',$id)->with('mountain')->firstorfail();
        $data['page_title'] = 'Update Mountain';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        return view('admin.experience.mountain', $data);
    }
    public function update_mountain(Request $request, $id)
    {
        //
        $rules = array(
            'mountain_view' => 'required',
            'view_of_ricefield' => 'required',
            'river_closeby' => 'required',
            'waterfall_closeby' => 'required',
            'activities' => 'required',
            'track_information' => 'required',
            'birdwatching' => 'required',
            'guide' => 'required'
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
            'mountain_view' => $request->mountain_view,
            'view_of_ricefield' => $request->view_of_ricefield,
            'river_closeby' => $request->river_closeby,
            'waterfall_closeby' => $request->waterfall_closeby,
            'activities' => $request->activities,
            'track_information' => $request->track_information,
            'birdwatching' => $request->birdwatching,
            'guide' => $request->guide,
            'other' => $request->other,
        );

        $villa = Villas::where('id',$id)->with('mountain')->firstorfail();
        $current = MountainVilla::findOrFail($villa->mountain->id);

        $current->update($object);

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    public function destroy_mountain($id)
    {
        $mountain = MountainVilla::where('id', $id)->firstOrFail();
        $mountain->delete();
        return redirect()->route('admin.villa.edit', ['id' => $mountain->id_villa])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed mountain.']);
    }
    public function create_retreats($id)
    {
        $data["page_title"] = 'Tambah Retreats';
        $data["villa"] = Villas::where('id',$id)->with('retreats')->firstorfail();
        // dd($data["villa"]->toArray());
        return view('admin.experience.retreats', $data);
    }
    public function store_retreats(Request $request, $id)
    {
        //\
        $rules = array(
            'workout_deck' => 'required',
            'house_chef' => 'required',
            'exclusive_rental' => 'required',
            'views_from_workout' => 'required',
            'gym' => 'required',
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

        $object = [
            'workout_deck' => $request->workout_deck,
            'house_chef' => $request->house_chef,
            'exclusive_rental' => $request->exclusive_rental,
            'views_from_workout' => $request->views_from_workout,
            'gym' => $request->gym,
            'id_villa' => $id,
            'other' => $request->other,
        ];
        Retreats::create($object);
        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_retreats($id)
    {
        $villa = Villas::where('id',$id)->with('retreats')->firstorfail();
        $data['page_title'] = 'Update Retreats';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        return view('admin.experience.retreats', $data);
    }
    public function update_retreats(Request $request, $id)
    {
        //
        $rules = array(
            'workout_deck' => 'required',
            'house_chef' => 'required',
            'exclusive_rental' => 'required',
            'views_from_workout' => 'required',
            'gym' => 'required',
        );
        $validator = Validator::make($request->all(), $rules,  $messages = [
            'required' => 'The :attribute field is required.',
            'file' => 'The :attribute must be a file.',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
                ->withInput();
        }
        $object = [
            'workout_deck' => $request->workout_deck,
            'house_chef' => $request->house_chef,
            'exclusive_rental' => $request->exclusive_rental,
            'views_from_workout' => $request->views_from_workout,
            'gym' => $request->gym,
            'other' => $request->other,
        ];
        $villa = Villas::where('id',$id)->with('retreats')->firstorfail();
        $current = Retreats::findOrFail($villa->retreats->id);

        $current->update($object);

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    
    }

    public function destroy_retreats($id)
    {
        // 
        $retreats = Retreats::where('id', $id)->firstOrFail();
        $retreats->delete();
        return redirect()->route('admin.villa.edit', ['id' => $retreats->id_villa])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed Retreats.']);
    }
    public function create_wedding(
        GetCurrencyService $getCurrencyService,
        $id
    ) {
        $data["page_title"] = 'Tambah Wedding';
        $data["villa"] = Villas::where('id',$id)->with('wedding')->firstorfail();
        // dd($data["villa"]->toArray());
        $data['currencies'] = $getCurrencyService->execute()->data;

        return view('admin.experience.wedding', $data);
    }
    public function store_wedding(
        StoreWeddingVillaService $storeWeddingVillaService,
        Request $request,
        $id
    ) {
         //\
        //  $rules = array(
        //     'standing_guests' => 'required',
        //     'seated_guests' => 'required',
        //     'additional_function_fee' => 'required',
        //     'banjar_fee' => 'required',
        //     'security_deposit' => 'required',
        //     'music_curfew' => 'required',
        //     'other_informasion' => 'required',
        //     'wedding_packages' => 'required',
        //     'wedding_packages_information' => 'required',
        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',
        // ]);
        // // dd($validator->messages());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        // $object = [
        //     'standing_guests' => $request->standing_guests,
        //     'seated_guests' => $request->seated_guests,
        //     'additional_function_fee' => $request->additional_function_fee,
        //     'banjar_fee' => $request->banjar_fee,
        //     'security_deposit' => $request->security_deposit,
        //     'music_curfew' => $request->music_curfew,
        //     'other_informasion' => $request->other_informasion,
        //     'wedding_packages' => $request->wedding_packages,
        //     'wedding_packages_information' => $request->wedding_packages_information,
        //     'id_villa' => $id,
        // ];
        // WeddingVilla::create($object);

        $storeWeddingVillaService->execute([
            'id_villa' => $id,
            'standing_guests' => $request->standing_guests,
            'seated_guests' => $request->seated_guests,
            'additional_function_fee' => $request->additional_function_fee,
            'banjar_fee' => $request->banjar_fee,
            'security_deposit' => $request->security_deposit,
            'music_curfew' => $request->music_curfew,
            'other_informasion' => $request->other_informasion,
            'wedding_packages' => $request->wedding_packages,
            'wedding_packages_information' => $request->wedding_packages_information,
            'additional_function_fee_currency' => $request->additional_function_fee_currency,
            'banjar_fee_currency' => $request->banjar_fee_currency,
            'security_deposit_currency' => $request->security_deposit_currency,
            'ocean_views' => $request->ocean_views,
            'garden_weddings' => $request->garden_weddings,
            'beachfront' => $request->beachfront,
            'other' => $request->other,
        ]);

        return redirect()->route('admin.villa.edit', ['id' => $id])->with(['notif_status' => '1', 'notif' => 'Insert Retreats data succeed.']);
    }
    public function edit_wedding(
        GetCurrencyService $getCurrencyService,
        Facilities $facilities,
        $id
    ) {
        $villa = Villas::where('id',$id)->with('wedding')->firstorfail();
        $data['page_title'] = 'Update Wedding';
        $data['edit_mode'] = true;
        $data['villa'] = $villa;
        $data['currencies'] = $getCurrencyService->execute()->data;

        return view('admin.experience.wedding', $data);
    }
    public function update_wedding(
        UpdateWeddingVillaService $updateWeddingVillaService,
        Request $request,
        $id
    ) {
        // $rules = array(
        //     'standing_guests' => 'required',
        //     'seated_guests' => 'required',
        //     'additional_function_fee' => 'required',
        //     'banjar_fee' => 'required',
        //     'security_deposit' => 'required',
        //     'music_curfew' => 'required',
        //     'other_informasion' => 'required',
        //     'wedding_packages' => 'required',
        //     'wedding_packages_information' => 'required',
        // );
        // $validator = Validator::make($request->all(), $rules,  $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'file' => 'The :attribute must be a file.',

        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->with(['notif_status' => '0', 'notif' => 'Insert data failed.'])
        //         ->withInput();
        // }
        // $object = [
        //     'standing_guests' => $request->standing_guests,
        //     'seated_guests' => $request->seated_guests,
        //     'additional_function_fee' => $request->additional_function_fee,
        //     'banjar_fee' => $request->banjar_fee,
        //     'security_deposit' => $request->security_deposit,
        //     'music_curfew' => $request->music_curfew,
        //     'other_informasion' => $request->other_informasion,
        //     'wedding_packages' => $request->wedding_packages,
        //     'wedding_packages_information' => $request->wedding_packages_information,
        // ];
        $villa = Villas::where('id',$id)->with('wedding')->firstorfail();
        // $current = WeddingVilla::findOrFail($villa->wedding->id);

        // $current->update($object);

        $updateWeddingVillaService->execute([
            'wedding_villa_id' => $villa->wedding->id,
            'id_villa' => $id,
            'standing_guests' => $request->standing_guests,
            'seated_guests' => $request->seated_guests,
            'additional_function_fee' => $request->additional_function_fee,
            'banjar_fee' => $request->banjar_fee,
            'security_deposit' => $request->security_deposit,
            'music_curfew' => $request->music_curfew,
            'other_informasion' => $request->other_informasion,
            'wedding_packages' => $request->wedding_packages,
            'wedding_packages_information' => $request->wedding_packages_information,
            'additional_function_fee_currency' => $request->additional_function_fee_currency,
            'banjar_fee_currency' => $request->banjar_fee_currency,
            'security_deposit_currency' => $request->security_deposit_currency,
            'ocean_views' => $request->ocean_views,
            'garden_weddings' => $request->garden_weddings,
            'beachfront' => $request->beachfront,
            'other' => $request->other,
        ]);

        return redirect()->route('admin.villa.edit', ['id' => $id])
        ->with(['notif_status' => '1', 'notif' => 'Update data succeed.']);
    }

    public function destroy_wedding($id)
    {
        $wedding = WeddingVilla::where('id', $id)->firstOrFail();
        $wedding->delete();
        return redirect()->route('admin.villa.edit', ['id' => $wedding->id_villa])
        ->with(['notif_status' => '1', 'notif' => 'Delete data succeed wedding.']);
    }

    public function changeStatus(Request $request)
    {
        $villa = Villas::findOrFail($request->id);
        $villa->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully.'
        ]);
    }
}
