<?php

namespace App\Services\VillaManagement\Villa\Sync;

use App\Models\Calender;
use App\Models\Villas;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SyncVillaIcalService implements BaseService
{
    public function execute(array $dto = []): object
    {
        $villa = Villas::find($dto['villa_id']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $villa->link_ical);
        
        $fileContents = curl_exec($ch);

        curl_close($ch);

        if(!empty($fileContents)) {
            $cek = preg_split("/\n|\r\n/", $fileContents);
            $search = array_search("BEGIN:VEVENT",$cek,true);

            for($i=1; $i < $search ; $i++) {
                unset($cek[$i]);
            }

            $data_filter = implode(',',$cek);

            $text = [
                "BEGIN:VCALENDAR", 
                ",BEGIN:VEVENT", 
                ",END:VEVENT,END:VCALENDAR,",
                ",END:VEVENT,END:VCALENDAR",
                ",END:VEVENT",
                ",DTEND;VALUE=DATE:",
                ",DTSTART;VALUE=DATE:",
                ",SUMMARY:",
                ",UID:",
                ",UUID:",
                ",DESCRIPTION:",
            ];
            $array   = [
                '[', 
                '{"text":"',
                '"}]', 
                '"}]', 
                '"},',
                ',end_date:',
                ',start_date:',
                ',summary:',
                ',uuid:',
                ',uuid:',
                ',description:'
            ];
            
            $data = trim(preg_replace('/\s+/', '', $data_filter));
            $newPhrase = str_replace($text, $array, $data);
            $json = json_decode($newPhrase);

            if(!empty($json)) {
                foreach ($json as $key => $value) {
                    $explode1 = explode(',',$value->text);
                    $result[$key]['uuid'] = "";
                    $result[$key]['start_date'] = "";
                    $result[$key]['end_date'] = "";
                    $result[$key]['description'] = "";
                    $result[$key]['summary'] = "";
                    $result[$key]['villa_id'] = $dto['villa_id'];
                    $result[$key]['created_at'] = now();
                    $result[$key]['updated_at'] = now();
    
                    foreach ($explode1 as $key1 => $value1) {
                        $explode2 = explode(':',$value1);
                        if($explode2[0]=='description'){
                            $result[$key][$explode2[0]] = preg_replace('/\s+/', '',str_replace('description:', '', $value1));
                        }elseif($explode2[0]=='start_date'){
                            $result[$key][$explode2[0]] = date_create_from_format("Ymd", substr($explode2[1],0,8));
                        }elseif($explode2[0]=='end_date'){
                            $result[$key][$explode2[0]] = date_create_from_format("Ymd", substr($explode2[1],0,8));
                        }elseif($explode2[0]=='uuid'){
                            $result[$key][$explode2[0]] = $explode2[1];
                        }elseif($explode2[0]=='summary'){
                            $result[$key][$explode2[0]] = $explode2[1];
                        }elseif(str_contains($value1, 'DTSTART')) {
                            $result[$key]['start_date'] = date_create_from_format("Ymd", substr($explode2[1],0,8));
                        }elseif(str_contains($value1, 'DTEND')) {
                            $result[$key]['end_date'] = date_create_from_format("Ymd", substr($explode2[1],0,8));
                        }
                    }
                }
    
                DB::table('calenders')->where('villa_id', $dto['villa_id'])->delete();
                Calender::insert($result);
            }
        }

        return (object) [
            'success' => true,
            'data' => $villa
        ];
    }
}
