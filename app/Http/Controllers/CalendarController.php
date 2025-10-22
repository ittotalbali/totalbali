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
        if (empty($request->ical_link) && empty($request->file('ical'))) {
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
            // Normalisasi line ending dan trim
            $fileContents = str_replace("\r\n", "\n", $fileContents);
            $fileContents = trim($fileContents);

            // Ambil semua VEVENT secara aman
            preg_match_all('/BEGIN:VEVENT(.*?)END:VEVENT/s', $fileContents, $matches);
            if (empty($matches[1])) {
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because no VEVENT found']);
            }

            $result = [];

            foreach ($matches[1] as $evtIndex => $evtBody) {
                // masing-masing event: cari field-field penting
                $uid = null;
                $summary = null;
                $description = null;
                $startDate = null;
                $endDate = null;

                // UID
                if (preg_match('/UID:(.+)/', $evtBody, $m)) {
                    $uid = trim($m[1]);
                }

                // SUMMARY
                if (preg_match('/SUMMARY:(.+)/', $evtBody, $m)) {
                    $summary = trim($m[1]);
                }

                // DESCRIPTION (multi-line juga di-handle, berhenti jika ada baris baru yang mirip PROPERTY:)
                if (preg_match('/DESCRIPTION:(.*?)(?=\n[A-Z0-9-]+:|\n$)/s', $evtBody, $m)) {
                    $description = trim(preg_replace('/\n[ \t]/', ' ', $m[1])); // unfold folded lines
                }

                // DTSTART (menangani DTSTART, DTSTART;VALUE=DATE, DTSTART;TZID=..., dan juga yang ada T...Z)
                if (preg_match('/DTSTART(?:;[^:]*)?:([0-9T]+Z?)/', $evtBody, $m)) {
                    $raw = $m[1];
                    $datePart = substr($raw, 0, 8);
                    if (preg_match('/^\d{8}$/', $datePart)) {
                        $startDate = date('Y-m-d', strtotime($datePart));
                    }
                }

                // DTEND (menangani format serupa)
                if (preg_match('/DTEND(?:;[^:]*)?:([0-9T]+Z?)/', $evtBody, $m)) {
                    $raw = $m[1];
                    $datePart = substr($raw, 0, 8);
                    if (preg_match('/^\d{8}$/', $datePart)) {
                        $endDate = date('Y-m-d', strtotime($datePart));
                    }
                }

                // Beberapa feed (VALUE=DATE) mungkin menyertakan DTEND sebagai satu hari setelah, tapi kita hanya pakai apa yang diberikan.

                // Jika tanggal valid ditemukan, tambahkan ke result
                $row = [
                    'uuid' => $uid ?? '',
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'description' => $description ?? '',
                    'summary' => $summary ?? '',
                    'villa_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $result[] = $row;
            }

            // Hapus entry tanpa tanggal valid
            $result = array_filter($result, function ($r) {
                return !empty($r['start_date']) && !empty($r['end_date']);
            });

            // Pastikan masih ada data
            if (empty($result)) {
                return redirect()->route('admin.villa.edit', ['id' => $id])
                    ->with(['notif_status' => '0', 'notif' => 'Import failed because no valid events found']);
            }

            // Replace semua entries untuk villa ini
            DB::table('calenders')->where('villa_id', $id)->delete();
            Calender::insert(array_values($result)); // array_values agar index numeric berurutan

            // Update link_ical hanya jika ada
            if (!empty($request->ical_link)) {
                $villa = Villas::find($id);
                if ($villa) {
                    $villa->update(['link_ical' => $request->ical_link]);
                }
            }

            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '1', 'notif' => 'Import data ical succeed.']);
        } catch (\Exception $e) {
            // Lebih baik log error di production daripada langsung throw
            \Log::error('ICS import error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '0', 'notif' => 'Import failed due to internal error']);
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
