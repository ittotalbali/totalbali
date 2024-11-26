<?php

namespace App\Console\Commands;

use App\Models\Villas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncVillaIcal extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'villa:sync_villa_ical';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Sync villa ical using stored ical link';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return int
    */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $villas = Villas::all();

            foreach($villas as $villa) {
                $villa->update([
                    "status" => 'post'
                ]);
            }

            DB::commit();
        }catch(\Exception $ex) {
            DB::rollBack();
        }
    }
}
