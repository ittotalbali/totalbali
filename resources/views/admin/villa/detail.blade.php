@extends('admin.layouts.master')
@section('page_content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Villa</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                @can('villa-create')
                    <a href="{{ route('admin.villa.create') }}">
                        <button class="btn btn-primary">Tambah</button>
                    </a>
                @endcan
            </div>
        </div> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h4">Villa</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.villa.search') }}">
                <button class="btn btn-outline-success">Kembali</button></a>
        </div>
    </div>

    @include('admin.layouts.alert')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline md-2">
                        <h6 class="card-title">Data Villa</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name Villa</td>
                                    <td>{{ $edit->name }}</td>
                                </tr>
                                <tr>
                                    <td>Type Accomodation</td>
                                    <td>{{ $edit->type_accomodation }}</td>
                                </tr>
                                <tr>
                                    <td>Type Privacy Guest</td>
                                    <td>{{ $edit->privacy_type }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $edit->countries->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Area</td>
                                    <td>{{ $edit->area->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{ $edit->location->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Location</td>
                                    <td>{{ $edit->sublocation->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $edit->address }}</td>
                                </tr>
                                <tr>
                                    <td>Link Maps</td>
                                    <td>{{ $edit->link_map }}</td>
                                </tr>
                                <tr>
                                    <td>Guest</td>
                                    <td>{{ $edit->guest }}</td>
                                </tr>
                                <tr>
                                    <td>Bedrooms</td>
                                    <td>{{ $edit->bedroom }}</td>
                                </tr>
                                <tr>
                                    <td>Bed</td>
                                    <td>{{ $edit->bed }}</td>
                                </tr>
                                <tr>
                                    <td>Bathroom</td>
                                    <td>{{ $edit->bathroom }}</td>
                                </tr>
                                <tr>
                                    <td>Facilities</td>
                                    <td>
                                        @foreach ($edit->facilities as $key => $item)
                                            {{ $item->name }}{{ $edit->facilities->count() == $key+1 ? '' : ',' }}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Staff</td>
                                    <td>{{ $edit->staff }}</td>
                                </tr>
                                <tr>
                                    <td>Landsize</td>
                                    <td>{{ $edit->landsize }}</td>
                                </tr>
                                <tr>
                                    <td>Buildingsize</td>
                                    <td>{{ $edit->buildingsize }}</td>
                                </tr>
                                <tr>
                                    <td>Year Built</td>
                                    <td>{{ $edit->yearbuilt }}</td>
                                </tr>
                                <tr>
                                    <td>Are pets allowed ?</td>
                                    <td>{{ $edit->pets }}</td>
                                </tr>
                                <tr>
                                    <td>Internet Information</td>
                                    <td>{{ $edit->internet }}</td>
                                </tr>
                                <tr>
                                    <td>Villa Code</td>
                                    <td>{{ $edit->code }}</td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>
                                    <td>{{ $edit->short }}</td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>
                                    <td>{{ $edit->long }}</td>
                                </tr>
                                <tr>
                                    <td>Old Link</td>
                                    <td>{{ $edit->old_link }}</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>{{ $edit->new_link }}</td>
                                </tr>
                                <tr>
                                    <td>Airbnb Link</td>
                                    <td>{{ $edit->airbnb_link }}</td>
                                </tr>
                                <tr>
                                    <td>Booking.com Link</td>
                                    <td>{{ $edit->bookingcom_link }}</td>
                                </tr>
                                <tr>
                                    <td>Galeries</td>
                                    <td>
                                        @foreach ($edit->galeries as $key => $item)
                                            <img src="{{ asset('uploads/' . $item->image) }}" alt="">
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Base Rate</td>
                                    <td>{{ number_format($edit->base_rate) }}</td>
                                </tr>
                                <tr>
                                    <td>Night Security / Satpam</td>
                                    <td>{{ $edit->security_night }}</td>
                                </tr>
                                <tr>
                                    <td>Day Security / Satpam</td>
                                    <td>{{ $edit->security_day }}</td>
                                </tr>
                                <tr>
                                    <td>CCTV</td>
                                    <td>{{ $edit->security_cctv }}</td>
                                </tr>
                                @if(isset($edit->pool))
                                <tr>
                                    <td>Pool</td>
                                    <td>{{ $edit->pool->pool }}</td>
                                </tr>
                                <tr>
                                    <td>Type Pool</td>
                                    <td>{{ $edit->pool->type }}</td>
                                </tr>
                                <tr>
                                    <td>Size Of Pool</td>
                                    <td>{{ $edit->pool->size_of_pool }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Bedroom</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td>Type Of Bedroom</td>
                                                <td>Number Of Bedroom</td>
                                                <td>Max Guests</td>
                                                <td>Charge per Extra Guest</td>
                                                <td>People Can Stay Per Room</td>
                                            </tr>
                                            @foreach ($edit->bedrooms as $key_bed => $item_bed)
                                            <tr>
                                                <td>{{ $item_bed->type_of_bedroom }}</td>
                                                <td>{{ $item_bed->number_of_bedrooms }}</td>
                                                <td>{{ $item_bed->max_guests }}</td>
                                                <td>{{ $item_bed->extra_guest_charge }}</td>
                                                <td>{{ $item_bed->people_can_stay_per_room }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                @if(isset($edit->inclusions))
                                <tr>
                                    <td>Inclusions</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td>Type</td>
                                                <td>Breakfast</td>
                                                <td>Airport</td>
                                                <td>Massage</td>
                                                <td>Anything Else</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{ $edit->inclusions->breakfast  }}</td>
                                                <td>{{ $edit->inclusions->airport  }}</td>
                                                <td>{{ $edit->inclusions->pijet }}</td>
                                                <td>{{ $edit->inclusions->anything_else }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $edit->inclusions->breakfast_description }}</td>
                                                <td>{{ $edit->inclusions->airport_description }}</td>
                                                <td>{{ $edit->inclusions->pijet_description }}</td>
                                                <td>{{ $edit->inclusions->anything_else_description }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                                @if(isset($edit->staff_new))
                                <tr>
                                    <td>House Keeper</td>
                                    <td>{{ $edit->staff_new->house_keeper }}</td>
                                </tr>
                                <tr>
                                    <td>Satpam</td>
                                    <td>{{ $edit->staff_new->satpam }}</td>
                                </tr>
                                <tr>
                                    <td>Manager</td>
                                    <td>{{ $edit->staff_new->manager }}</td>
                                </tr>
                                <tr>
                                    <td>Chef</td>
                                    <td>{{ $edit->staff_new->chef }}</td>
                                </tr>
                                <tr>
                                    <td>Gardener</td>
                                    <td>{{ $edit->staff_new->gardener }}</td>
                                </tr>
                                <tr>
                                    <td>Driver</td>
                                    <td>{{ $edit->staff_new->driver }}</td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>{{ $edit->staff_new->other }}</td>
                                </tr>
                                @endif
                                @if(isset($edit->chef))
                                <tr>
                                    <td>Chef</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td width="20%">Status</td>
                                                <td width="20%">Cost</td>
                                                <td>Information</td>
                                            </tr>
                                            <tr>
                                                <td>{{  $edit->chef->chef   }}</td>
                                                <td>{{ number_format($edit->chef->cost) }}</td>
                                                <td>{{ $edit->chef->information }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                                @if(isset($edit->car))
                                <tr>
                                    <td>Car And Driver</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td width="20%">{{ $edit->car->system_for_use }}</td>
                                                <td width="20%">{{ number_format($edit->car->cost) }}</td>
                                                <td>{{ $edit->car->information }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Album</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            @foreach ($edit->album as $key_al => $item_al)
                                            <tr>
                                                <td>{{ $item_al->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $item_al->deskripsi }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    @foreach ($item_al->galeri_album as $key_gal => $item_gal)
                                                    <img src="{{ asset('uploads/' . $item_gal->image) }}" alt="">
                                                    @endforeach
                                                </td>
                                            </tr>
                                                
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                @if(isset($edit->floorplan))
                                <tr>
                                    <td>Floorplan</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td colspan="2">{{ $edit->floorplan->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $edit->floorplan->deskripsi }}</td>
                                            </tr>
                                            <tr>
                                                @foreach ($edit->floorplan->galeri_floorplan as $key_pla => $item_pla)
                                                <td>
                                                    <img src="{{ asset('uploads/' . $item_pla->gambar) }}" alt="">
                                                </td>
                                                <td>
                                                    {{ $item_pla->deskripsi }}
                                                </td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                                @if(isset($edit->pricing))
                                <tr>
                                    <td>Monthly Rental</td>
                                    <td>{{ $edit->pricing->monthly_rental }}</td>
                                </tr>
                                <tr>
                                    <td>Monthly Description</td>
                                    <td>{{ $edit->pricing->monthly_description }}</td>
                                </tr>
                                <tr>
                                    <td>Yearly Rental</td>
                                    <td>{{ $edit->pricing->yearly_rental }}</td>
                                </tr>
                                <tr>
                                    <td>Yearly Description</td>
                                    <td>{{ $edit->pricing->yearly_description }}</td>
                                </tr>
                                <tr>
                                    <td>Available For Sales</td>
                                    <td>{{ $edit->pricing->available_for_sales_rental }}</td>
                                </tr>
                                <tr>
                                    <td>Available For Sales Description</td>
                                    <td>{{ $edit->pricing->available_for_sales_description }}</td>
                                </tr>
                                <tr>
                                    <td>Long Term Rental</td>
                                    <td>{{ $edit->pricing->long_term_rental }}</td>
                                </tr>
                                <tr>
                                    <td>Long Term Sales</td>
                                    <td>{{ $edit->pricing->long_term_sales }}</td>
                                </tr>
                                <tr>
                                    <td>Freehold</td>
                                    <td>{{ $edit->pricing->freehold }}</td>
                                </tr>
                                <tr>
                                    <td>Leasehold</td>
                                    <td>{{ $edit->pricing->leasehold }}</td>
                                </tr>
                                <tr>
                                    <td>Leasehold Description</td>
                                    <td>{{ $edit->pricing->leasehold_description }}</td>
                                </tr>
                                @endif
                                @if ($edit->retreats != null)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Retreats Villa</td>
                                </tr>
                                <tr>
                                    <td>Workout Deck</td>
                                    <td>{{ $edit->retreats->workout_deck }}</td>
                                </tr>
                                <tr>
                                    <td>Exlusive Rental</td>
                                    <td>{{ $edit->retreats->exclusive_rental }}</td>
                                </tr>
                                <tr>
                                    <td>House Chef</td>
                                    <td>{{ $edit->retreats->house_chef }}</td>
                                </tr>
                                <tr>
                                    <td>Views From Workout</td>
                                    <td>{{ $edit->retreats->views_from_workout }}</td>
                                </tr>
                                <tr>
                                    <td>Gym</td>
                                    <td>{{ $edit->retreats->gym }}</td>
                                </tr>
                                @endif
                                @if ($edit->wedding != null)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Wedding Villa</td>
                                </tr>
                                <tr>
                                    <td>Standing Guest</td>
                                    <td>{{ $edit->wedding->standing_guests }}</td>
                                </tr>
                                <tr>
                                    <td>Seated Guest</td>
                                    <td>{{ $edit->wedding->seated_guests }}</td>
                                </tr>
                                <tr>
                                    <td>Additional Function Fee</td>
                                    <td>{{ $edit->wedding->additional_function_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Banjar Fee</td>
                                    <td>{{ $edit->wedding->banjar_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Security Deposit</td>
                                    <td>{{ $edit->wedding->security_deposit }}</td>
                                </tr>
                                <tr>
                                    <td>Music Curfew</td>
                                    <td>{{ $edit->wedding->music_curfew }}</td>
                                </tr>
                                <tr>
                                    <td>Other Information</td>
                                    <td>{{ $edit->wedding->other_informasion }}</td>
                                </tr>
                                <tr>
                                    <td>Weeding Packgaes</td>
                                    <td>{{ $edit->wedding->wedding_packages }}</td>
                                </tr>
                                <tr>
                                    <td>Wedding Packgaes Information</td>
                                    <td>{{ $edit->wedding->wedding_packages_information }}</td>
                                </tr>
                                @endif
                                @if ($edit->mountain != null)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Mountains Villa</td>
                                </tr>
                                <tr>
                                    <td>Montain View</td>
                                    <td>{{ $edit->mountain->mountain_view }}</td>
                                </tr>
                                <tr>
                                    <td>View Of Recifield</td>
                                    <td>{{ $edit->mountain->view_of_ricefield }}</td>
                                </tr>
                                <tr>
                                    <td>Rover Closeby</td>
                                    <td>{{ $edit->mountain->rover_closeby }}</td>
                                </tr>
                                <tr>
                                    <td>Waterfall Closeby</td>
                                    <td>{{ $edit->mountain->waterfall_closeby }}</td>
                                </tr>
                                <tr>
                                    <td>Activities</td>
                                    <td>{{ $edit->mountain->activities }}</td>
                                </tr>
                                <tr>
                                    <td>Track Information</td>
                                    <td>{{ $edit->mountain->track_information }}</td>
                                </tr>
                                <tr>
                                    <td>Birdwatching</td>
                                    <td>{{ $edit->mountain->birdwatching }}</td>
                                </tr>
                                <tr>
                                    <td>Guide</td>
                                    <td>{{ $edit->mountain->guide }}</td>
                                </tr>
                                @endif
                                @if ($edit->close_clubs->count() > 0)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Close To The Club</td>
                                </tr>
                                @foreach ($edit->close_clubs as $club)    
                                <tr>
                                    <td>Club Name</td>
                                    <td>{{ $club->club_name }}</td>
                                </tr>
                                <tr>
                                    <td>Type Of Club</td>
                                    <td>{{ $club->type_of_club }}</td>
                                </tr>
                                <tr>
                                    <td>Good Days</td>
                                    <td>{{ $club->good_days }}</td>
                                </tr>
                                @endforeach
                                @endif
                                @if ($edit->family != null)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Family Villa</td>
                                </tr>
                                <tr>
                                    <td>Pool Fence</td>
                                    <td>{{ $edit->family->pool_fence }}</td>
                                </tr>
                                <tr>
                                    <td>Baby Cot</td>
                                    <td>{{ $edit->family->baby_cot }}</td>
                                </tr>
                                <tr>
                                    <td>Infant Cot</td>
                                    <td>{{ $edit->family->infant_cot }}</td>
                                </tr>
                                <tr>
                                    <td>Baby High Chair</td>
                                    <td>{{ $edit->family->baby_high_chair }}</td>
                                </tr>
                                <tr>
                                    <td>Chef</td>
                                    <td>{{ $edit->family->chef }}</td>
                                </tr>
                                <tr>
                                    <td>Costs For Chef</td>
                                    <td>{{ $edit->family->costs_for_chef }}</td>
                                </tr>
                                <tr>
                                    <td>Nanny Cost</td>
                                    <td>{{ $edit->family->nanny_cost }}</td>
                                </tr>
                                <tr>
                                    <td>Included / Cost per day</td>
                                    <td>{{ $edit->family->included }}</td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td><img src="{{ asset('uploads/'.$edit->family->photos) }}" alt=""></td>
                                </tr>
                                @endif
                                @if ($edit->beach != null)
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Beach Villa</td>
                                </tr>
                                <tr>
                                    <td>What Beach</td>
                                    <td>{{ $edit->beach->what_beach }}</td>
                                </tr>
                                <tr>
                                    <td>How Far Walking</td>
                                    <td>{{ $edit->beach->how_far_walking }}</td>
                                </tr>
                                <tr>
                                    <td>Views Of Ocean</td>
                                    <td>{{ $edit->beach->views_of_ocean }}</td>
                                </tr>
                                <tr>
                                    <td>Surf Villa</td>
                                    <td>{{ $edit->beach->surf_villa }}</td>
                                </tr>
                                <tr>
                                    <td>Waves Nearby</td>
                                    <td>{{ $edit->beach->waves_nearby }}</td>
                                </tr>
                                <tr>
                                    <td>Extra Information</td>
                                    <td>{{ $edit->beach->extra_information }}</td>
                                </tr>
                                <tr>
                                    <td>Other Information</td>
                                    <td>{{ $edit->beach->other_information }}</td>
                                </tr>
                                @endif
                                @if ($edit->rate->count() > 0)    
                                <tr>
                                    <td class="bg-secondary text-light" colspan="2">Rates</td>
                                </tr>
                                @foreach ($edit->rate as $rate)    
                                <tr>
                                    <td>{{ ucwords(str_replace('_', ' ', $rate->type)) }}</td>
                                    <td class="p-0">
                                        <table class="table table-bordered" style="">
                                            <tr>
                                                <td width="20%">Details</td>
                                                <td width="20%">Price</td>
                                                <td width="20%">Start Date</td>
                                                <td width="20%">End Date</td>
                                            </tr>
                                            <tr>
                                                <td>{{  $rate->details   }}</td>
                                                <td>
                                                    @foreach ($rate->rooms as $room)
                                                        {{ $room['total_bedroom'] }} Bedroom {{ $room['currency'] }} {{ number_format($room['price']) }} <br>
                                                    @endforeach
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($rate->start_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($rate->end_date)) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('include-css')
@endsection
@section('include-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endsection
