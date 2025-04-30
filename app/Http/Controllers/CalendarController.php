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
        return view('admin.calender.index', ['page_title' => 'Manajemen Facilities']);
    }

    public function import(Request $request, $id)
    {
        $fileContents = '';

        if (empty($request->ical_link) && !$request->hasFile('ical')) {
            return $this->redirectFail($id, 'Ical link or file required');
        }

        try {
            if (!empty($request->ical_link)) {
                $fileContents = $this->fetchIcalFromUrl($request->ical_link);
            } elseif ($request->hasFile('ical')) {
                $fileContents = file_get_contents($request->file('ical')->getRealPath());
            }

            if (empty($fileContents)) {
                return $this->redirectFail($id, 'Import failed because file is empty');
            }

            $events = $this->parseIcal($fileContents, $id);

            if (empty($events)) {
                return $this->redirectFail($id, 'No valid event found in iCal');
            }

            DB::table('calenders')->where('villa_id', $id)->delete();
            Calender::insert($events);

            Villas::where('id', $id)->update(['link_ical' => $request->ical_link]);

            return redirect()->route('admin.villa.edit', ['id' => $id])
                ->with(['notif_status' => '1', 'notif' => 'Import data ical succeed.']);
        } catch (\Exception $e) {
            return $this->redirectFail($id, 'Import failed: ' . $e->getMessage());
        }
    }

    private function fetchIcalFromUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
        ]);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $data;
    }

    private function parseIcal($content, $villaId)
    {
        $lines = preg_split("/\r\n|\n|\r/", $content);
        $events = [];
        $event = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === 'BEGIN:VEVENT') {
                $event = ['villa_id' => $villaId, 'created_at' => now(), 'updated_at' => now()];
            } elseif ($line === 'END:VEVENT') {
                if (!empty($event['start_date']) && !empty($event['end_date'])) {
                    $events[] = $event;
                }
                $event = [];
            } elseif (strpos($line, 'DTSTART') === 0) {
                $event['start_date'] = $this->parseDate($line);
            } elseif (strpos($line, 'DTEND') === 0) {
                $event['end_date'] = $this->parseDate($line);
            } elseif (strpos($line, 'SUMMARY:') === 0) {
                $event['summary'] = substr($line, 8);
            } elseif (strpos($line, 'DESCRIPTION:') === 0) {
                $event['description'] = substr($line, 12);
            } elseif (strpos($line, 'UID:') === 0 || strpos($line, 'UUID:') === 0) {
                $event['uuid'] = explode(':', $line)[1] ?? '';
            }
        }

        return $events;
    }

    private function parseDate($line)
    {
        $parts = explode(':', $line);
        $date = end($parts);
        return \DateTime::createFromFormat('Ymd', substr($date, 0, 8)) ?: null;
    }

    private function redirectFail($id, $message)
    {
        return redirect()->route('admin.villa.edit', ['id' => $id])
            ->with(['notif_status' => '0', 'notif' => $message]);
    }

    public function kalender($id_villa)
    {
        $data = Calender::where('villa_id', $id_villa)->orderBy('start_date')->get();
        $events = [];

        foreach ($data as $key => $value) {
            $bgColor = match ($value->type) {
                'low' => 'rgb(23,162,184, 50%)',
                'peak' => 'rgb(255,0,0, 50%)',
                default => 'rgb(0,123,255, 50%)',
            };

            $events[$key] = [
                'id' => $value->id,
                'start' => $value->start_date->format('Y-m-d') . 'T00:00:00',
                'end' => $value->end_date->format('Y-m-d') . 'T24:00:00',
                'title' => $value->summary,
                'backgroundColor' => $bgColor,
                'borderColor' => 'rgba(68, 84, 195, 0.15)',
            ];
        }

        return response()->json($events);
    }

    public function verifyDownloadableUrl(string $url): bool
    {
        $headers = @get_headers($url);
        return $headers !== false && preg_match('/^HTTP\/\d+ (200|301|302|303)/', $headers[0]);
    }
}
