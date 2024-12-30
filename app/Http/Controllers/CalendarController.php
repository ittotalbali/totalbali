<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calender;
use App\Models\Villas;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    
    public function index()
    {
        $data["page_title"] = 'Manajemen Facilities';
        return view('admin.calender.index', $data);
    }
    public function import(Request $request, $id)
    {
        // dd($id);
        // $rules = array(
        //     'ical' => 'required',
        // );

        if(!empty($request->ical_link)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $request->ical_link);
            
            $fileContents = curl_exec($ch);

            curl_close($ch);
        }else {
            $file = $request->file('ical');
            $fileContents = file_get_contents($file);
        }
        // $url = $request->link;
        // Open the file for reading
        // $url = "https://www.example.com/downloadable_file.pdf"; // Replace with your URL

        // if ($this->verifyDownloadableUrl($url)) {
        //     dd('The URL may point to a downloadable file, but content type verification is not performed.');
        // } else {
        //     dd('The URL may not point to a downloadable file, or an error occurred.');
        // }

        if(empty($fileContents)) {
            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '0', 'notif' => 'Import failed because empty. link successfully updated!']);
        }
        
        try {
            $cek = preg_split("/\n|\r\n/", $fileContents);
            $search = array_search("BEGIN:VEVENT",$cek,true);
            for ($i=1; $i < $search ; $i++) { 
                unset($cek[$i]);
            }
            $data_filter = implode(',',$cek);
            // dd($data_filter);
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

            if(empty($json)) {
                if (!empty($request->ical_link)) {
                Villas::find($id)->update(['link_ical' => $request->ical_link]);
            }
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because empty. link successfully updated!']);
            }

            // return $json;
            foreach ($json as $key => $value) {
                $explode1 = explode(',',$value->text);
                $result[$key]['uuid'] = "";
                $result[$key]['start_date'] = "";
                $result[$key]['end_date'] = "";
                $result[$key]['description'] = "";
                $result[$key]['summary'] = "";
                $result[$key]['villa_id'] = $id;
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

            // return $result;
            DB::table('calenders')->where('villa_id', $id)->delete();
            Calender::insert($result);

            if(!empty($request->ical_link)) {
                $villa = Villas::find($id);
                $villa->update([
                    'link_ical' => $request->ical_link
                ]);
            }else {
                $villa = Villas::find($id);
                $villa->update([
                    'link_ical' => $request->ical_link
                ]);
            }

            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '1', 'notif' => 'Import data ical succeed.']);
        } catch (\Exception $e) {
            throw $e;
        }
       
        
    }
    public function kalender($id_villa)
    {
        //
        $data = Calender::where('villa_id', $id_villa)->orderBy('start_date')->get();
        // dd($data->toArray());
        $events = [];
        foreach ($data as $key => $value) {
            if ($value->type == 'base') {
                $bgColor = 'rgb(0,123,255, 50%)';
            } else if ($value->type == 'low') {
                $bgColor = 'rgb(23,162,184, 50%)';
            } else if ($value->type == 'peak') {
                $bgColor = 'rgb(255,0,0, 50%)';
            } else {
                $bgColor = 'rgb(0,123,255, 50%)';
            }

            $events[$key]['id'] = $value->id;
            $events[$key]['start'] = date('Y-m-d', strtotime($value->start_date)) . 'T00:00:00';
            $events[$key]['end'] = date('Y-m-d', strtotime($value->end_date)) . 'T24:00:00';
            $events[$key]['title'] = $value->summary;
            $events[$key]['backgroundColor'] = $bgColor;
            $events[$key]['borderColor'] = 'rgba(68, 84, 195, 0.15)';
            // $events[$key]['description'] = $value->name;
        }
        // dd($data->toArray());
        return response()->json($events);
    }
    public function verifyDownloadableUrl(string $url): bool
    {
        $headers = @get_headers($url);
        if ($headers !== false && preg_match('/^HTTP\/\d+ (200|301|302|303)/', $headers[0])) {
            return true;
        }

        return false;
    }

    
}
