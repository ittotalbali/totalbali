<?php

namespace App\Services\VillaManagement\Villa\Sync;

use App\Models\Villas;
use App\Services\BaseService;

class SyncVillaIcalService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villas = Villas::where('status', 'draft')
        ->whereNotNull('link_ical')
        ->get();

        foreach($villas as $villa) {
            $villa->update([
                "status" => 'post'
            ]);
        }

        return (object) [
            'success' => true,
            'data' => $villas
        ];
    }
}
