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
        if (empty($request->ical_link) and empty($request->file('ical'))) {
            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '0', 'notif' => 'Ical link or file required']);
        }

        if (!empty($request->ical_link)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $request->ical_link);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0');

            $fileContents = curl_exec($ch);

            curl_close($ch);
        } else {
            $file = $request->file('ical');
            $fileContents = file_get_contents($file);
        }

        if (empty($fileContents)) {
            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '0', 'notif' => 'Import failed because empty']);
        }

        try {
            $cek = preg_split("/\n|\r\n/", $fileContents);
            $search = array_search("BEGIN:VEVENT", $cek, true);
            for ($i = 1; $i < $search; $i++) {
                unset($cek[$i]);
            }
            $data_filter = implode(',', $cek);

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
                ",DTSTART:",
                ",DTEND:",
                ",DTSTART;TZID=", // ✅ tambahkan ini
                ",DTEND;TZID=",   // ✅ dan ini
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
                ',description:',
                ',start_date:',
                ',end_date:',
                ',start_date:',   // ✅ untuk DTSTART;TZID
                ',end_date:',     // ✅ untuk DTEND;TZID
            ];

            $data = trim(preg_replace('/\s+/', '', $data_filter));
            $newPhrase = str_replace($text, $array, $data);
            $json = json_decode($newPhrase);

            if (empty($json) and !empty($newPhrase)) {
                $newPhrase = str_replace("[{", "", $newPhrase);
                $newPhrase = str_replace("}]", "", $newPhrase);
                $newPhrase = str_replace('"text":",', "", $newPhrase);
                $newPhrase = str_replace('"', "", $newPhrase);
                $newPhrase = explode('},{', $newPhrase);

                $json = [];
                foreach ($newPhrase as $value) {
                    $json[] = (object) [
                        'text' => $value
                    ];
                }
            }

            if (empty($json)) {
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because empty']);
            }

            if (!str_contains($json[0]->text, 'start_date')) {
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because start date not found']);
            }

            if (!str_contains($json[0]->text, 'end_date')) {
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because end date not found']);
            }

            foreach ($json as $key => $value) {
                if (!is_object($value) || !property_exists($value, 'text')) {
                    continue; // Lewatkan jika bukan objek atau tidak ada "text"
                }
                $explode1 = explode(',', $value->text);
                $result[$key]['uuid'] = "";
                $result[$key]['start_date'] = "";
                $result[$key]['end_date'] = "";
                $result[$key]['description'] = "";
                $result[$key]['summary'] = "";
                $result[$key]['villa_id'] = $id;
                $result[$key]['created_at'] = now();
                $result[$key]['updated_at'] = now();

                foreach ($explode1 as $key1 => $value1) {
                    $explode2 = explode(':', $value1);
                    if ($explode2[0] == 'description') {
                        $result[$key][$explode2[0]] = preg_replace('/\s+/', '', str_replace('description:', '', $value1));
                    } elseif ($explode2[0] == 'start_date') {
                        $result[$key][$explode2[0]] = date_create_from_format("Ymd", substr($explode2[1], 0, 8));
                    } elseif ($explode2[0] == 'end_date') {
                        $result[$key][$explode2[0]] = date_create_from_format("Ymd", substr($explode2[1], 0, 8));
                    } elseif ($explode2[0] == 'uuid') {
                        $result[$key][$explode2[0]] = $explode2[1];
                    } elseif ($explode2[0] == 'summary') {
                        $result[$key][$explode2[0]] = $explode2[1];
                        // Tambahan: deteksi format dengan TZID (contoh: DTSTART;TZID=Asia/Makassar:20251107T150000)
                    } elseif (preg_match('/DTSTART(;TZID=[^:]+)?:([0-9T]+)/', $value1, $m)) {
                        $date = substr($m[2], 0, 8);
                        $result[$key]['start_date'] = date_create_from_format("Ymd", $date);
                    } elseif (preg_match('/DTEND(;TZID=[^:]+)?:([0-9T]+)/', $value1, $m)) {
                        $date = substr($m[2], 0, 8);
                        $result[$key]['end_date'] = date_create_from_format("Ymd", $date);

                        // Format lama tetap dipertahankan untuk kompatibilitas
                    } elseif (str_contains($value1, 'DTSTART')) {
                        $result[$key]['start_date'] = date_create_from_format("Ymd", substr($explode2[1], 0, 8));
                    } elseif (str_contains($value1, 'DTEND')) {
                        $result[$key]['end_date'] = date_create_from_format("Ymd", substr($explode2[1], 0, 8));
                    }
                }
            }

            DB::table('calenders')->where('villa_id', $id)->delete();
            Calender::insert($result);

            if (!empty($request->ical_link)) {
                $villa = Villas::find($id);
                $villa->update([
                    'link_ical' => $request->ical_link
                ]);
            } else {
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
