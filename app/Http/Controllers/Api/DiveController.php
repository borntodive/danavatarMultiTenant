<?php

namespace App\Http\Controllers\Api;

use App\Events\ProgressEvent;
use App\Helpers\DecoCalculator;
use App\Helpers\DiveParser;
use App\Models\Dive;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;



class DiveController extends \App\Http\Controllers\Controller
{
    public function get(Request $request, Dive $dive)
    {
        $gfHi = $request->get('gf_hi', 80);
        $gfLow = $request->get('gf_low', 40);
        $out = $dive->toArray();
        //$out['profile'] = $dive->profile;
        $decoCalc = new DecoCalculator($dive);
        $out['ceil'] = $decoCalc->calculateCeiling($gfHi / 100, $gfLow / 100);
        return $out;
    }

    public function getByUser(Request $request, $user_id)
    {
        ProgressEvent::dispatch("LOADING_DIVES", null);

        $perPage = 9;
        $page = $request->get('page', 1);
        $sort = $request->get('sort', 'date');
        $sortDirection = $request->get('sortDirection', 'DESC');
        $filters = json_decode($request->get('filters', '{}'));
        $dates = json_decode($request->get('dates', null));
        $q = Dive::where('user_id', $user_id)->orderBy($sort, $sortDirection);
        if ($filters) {
            $q = $q->where(function ($q) use ($filters) {
                foreach ($filters as $idx => $filter) {
                    if ($filter->field == 'dcs') {
                        if ($idx === 0)
                            $q = $q->where($filter->field, 'exists', filter_var($filter->value, FILTER_VALIDATE_BOOLEAN));
                        else
                            $q = $q->orWhere($filter->field, 'exists', filter_var($filter->value, FILTER_VALIDATE_BOOLEAN));
                    } else {
                        if ($idx === 0)
                            $q = $q->where($filter->field, $filter->value);
                        else
                            $q = $q->orWhere($filter->field, $filter->value);
                    }
                }
            });
        }
        if ($dates) {
            $sD = new Carbon($dates->startDate);
            $eD = new Carbon($dates->endDate);
            $q = $q->whereBetween('date', [$sD, $eD]);
        }
        ProgressEvent::dispatch("LOADING_DIVES", 0);
        $totalFound = $q->count();

        $dives = $q->offset(($page - 1) * $perPage)->limit($perPage)->get();
        $out = [];
        $out['dives'] = $dives;
        $divesCount = Dive::where('user_id', $user_id)->count();
        $out['pagination']['current'] = (int)$page;
        $out['pagination']['total'] = ceil($totalFound / $perPage);
        $out['pagination']['totalDives'] = $divesCount;
        $out['pagination']['perPage'] = $perPage;

        return $out;
    }

    public function store(Request $request)
    {

        $ext = $request->file->extension();
        $path = $request->file->store('dives');
        $type = $request->type;
        $user_id = $request->user()->id;
        $diveParser = new DiveParser(file_get_contents($request->file), $type, $user_id);
        $messages = $diveParser->parseUDDF();
        return response()->json($messages);
    }
    public function storeTank(Request $request, Dive $dive)
    {
        $validated = $request->validate([
            'time' => 'required|max:255',
            'o2' => 'required|integer',
            'n2' => 'required|integer',
            'he' => 'required|integer',
            'start' => 'integer|nullable',
            'end' => 'integer|nullable',
            'volume' => 'integer|nullable',
        ]);
        list($minuntes, $seconds) = explode(':', $validated['time']);
        $time = ($minuntes * 60) + $seconds;
        unset($validated['time']);
        ProgressEvent::dispatch("SAVING_TANK", 0);
        $profile = $dive->profile;
        $p_count = count($profile);
        foreach ($profile as $idx => $sample) {
            $perc = ceil(($idx + 1) * 100 / $p_count);
            if ($perc > 100)
                $perc = 100;
            ProgressEvent::dispatch("SAVING_TANK", $perc);
            if ($sample['timesec'] == $time) {
                $profile[$idx]['gases'] = $validated;
                $profile[$idx]['marker'] = DiveParser::getMarkerUrl($validated);
                $dive->profile = $profile;
                $dive->save();
                $decoCalc = new DecoCalculator($dive);
                $decoCalc->calculateGF();
                $messages['success'] = true;
                break;
            }
        }
        if (!isset($messages['success']))
            $messages['warning'] = true;
        return $messages;
    }
    public function deleteTank(Request $request, Dive $dive)
    {

        $validated = $request->validate([
            'time' => 'required|max:255',

        ]);
        list($minuntes, $seconds) = explode(':', $validated['time']);
        $time = ($minuntes * 60) + $seconds;
        unset($validated['time']);
        ProgressEvent::dispatch("DELETING_TANK", 0);
        $profile = $dive->profile;
        $p_count = count($profile);
        foreach ($profile as $idx => $sample) {
            $perc = ceil(($idx + 1) * 100 / $p_count);
            if ($perc > 100)
                $perc = 100;
            ProgressEvent::dispatch("DELETING_TANK", $perc);
            if ($sample['timesec'] == $time) {
                unset($profile[$idx]['gases']);
                unset($profile[$idx]['marker']);
                $dive->profile = $profile;
                $dive->save();
                $decoCalc = new DecoCalculator($dive);
                $decoCalc->calculateGF();
                $messages['success'] = true;
                break;
            }
        }
        if (!isset($messages['success']))
            $messages['warning'] = true;
        return $messages;
    }
}
