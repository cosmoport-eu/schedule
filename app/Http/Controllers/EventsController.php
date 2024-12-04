<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Events;
use App\Models\Gates;
use App\Models\Settings;
use App\Models\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class EventsController
 * @package App\Http\Controllers
 */
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pause = Settings::whereParameter('pause')->first();
        $range = is_null($pause) ? 5 : $pause->value;

        return view('events.index', [
            'records' => Events::with('typeEn', 'statusEn', 'departureGateEn')
                ->orderBy('date', 'DESC')
                ->orderBy('time_start', 'DESC')
                ->paginate(5),
            'range' => $range
        ]);
    }

    /**
     * @param $departure_gate_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function gate($departure_gate_id)
    {
        return view('gates.index', [
            'departure_gate_id' => $departure_gate_id
        ]);
    }

    /**
     * для отображения в таблице предстоящих события на Гейте
     *
     * @param $departure_gate_id
     * @return mixed
     */
    public function nextEventsForGate($departure_gate_id)
    {
        return Events::where('date', '=', Carbon::now()->format('Y-m-d'))
            ->whereStatusId(Statuses::WAITING)
            ->whereDepartureGateId($departure_gate_id)
            ->with('type', 'status', 'departureGate')
            ->orderBy('time_start', 'asc')
            ->limit(2)
            ->get();
    }

    /**
     * @param $departure_gate_id
     * @return Events|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getCurrentForGate($departure_gate_id)
    {
        return Events::where('date', '=', Carbon::now()->format('Y-m-d'))
            ->whereDepartureGateId($departure_gate_id)
            ->whereIn('status_id', [
                Statuses::BOARDING,
                Statuses::DEPARTED,
                Statuses::RETURNING
            ])
            ->with('type', 'status', 'departureGate')
            ->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::with(['typesEn.subtypesEn'])->get();
        $gates = Gates::with('translationEn')->get();

        return view('events.create', compact('categories', 'gates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|exists:categories,i18n_name_code',
            'type_id' => 'required|integer|exists:types,id',
            'subtype_id' => 'nullable|integer|exists:types,id',
            'gate_id' => 'required|integer|exists:gates,id',
            'date' => 'required|string',
            'time_start' => 'required|string|max:255',
            'duration_hours' => 'nullable|integer|min:0|max:23',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'cost' => 'nullable|numeric|min:0',
            'people_limit' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ]);

        $type_id = $validatedData['subtype_id'] ?? $validatedData['type_id'];
        $time_end = Carbon::parse($validatedData['time_start'])
            ->addHours($validatedData['duration_hours'])
            ->addMinutes($validatedData['duration_minutes'])
            ->format('H:i');

        $hours = $validatedData['duration_hours'] ?? 0;
        $minutes = $validatedData['duration_minutes'] ?? 0;
        $duration = ($hours * 60) + $minutes;

        $date = Carbon::now()->format('Y-m-d H:i:s');

        Events::create([
            'date' => $validatedData['date'],
            'time_start' => Carbon::parse("{$validatedData['date']} {$validatedData['time_start']}")->format('Y-m-d H:i:s'),
            'time_end' => Carbon::parse("{$validatedData['date']} $time_end")->format('Y-m-d H:i:s'),
//            'time_start' => $validatedData['time_start'],
//            'time_end' => $time_end,
            'description' => $validatedData['description'],
            'duration' => $duration,
            'type_id' => $type_id,
            'status_id' => Statuses::WAITING,
            'departure_gate_id' => $validatedData['gate_id'],
            'arrival_gate_id' => $validatedData['gate_id'],
            'people_limit' => $validatedData['people_limit'],
            'cost' => $validatedData['cost'],
            'created_at' => $date,
            'updated_at' => $date
        ]);

        return back()
            ->withInput($validatedData)
            ->with('success', 'Record Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::whereId($id)
            ->with('typeEn', 'statusEn', 'departureGateEn')
            ->first();
        $categories = Categories::with(['typesEn.subtypesEn'])->get();
        $gates = Gates::with('translationEn')->get();
        $statuses = Statuses::with('translationEn')->get();

        return view('events.edit', compact('event', 'categories', 'gates', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|exists:categories,i18n_name_code',
            'type_id' => 'required|integer|exists:types,id',
            'subtype_id' => 'nullable|integer|exists:types,id',
            'gate_id' => 'required|integer|exists:gates,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'date' => 'required|string',
            'time_start' => 'required|string|max:255',
            'duration_hours' => 'nullable|integer|min:0|max:23',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'cost' => 'nullable|numeric|min:0',
            'people_limit' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ]);

        $model = Events::whereId($id)
            ->firstOrFail();

        $type_id = $validatedData['subtype_id'] ?? $validatedData['type_id'];
        $time_end = Carbon::parse($validatedData['time_start'])
            ->addHours($validatedData['duration_hours'])
            ->addMinutes($validatedData['duration_minutes'])
            ->format('H:i');

        $hours = $validatedData['duration_hours'] ?? 0;
        $minutes = $validatedData['duration_minutes'] ?? 0;
        $duration = ($hours * 60) + $minutes;

        $date = Carbon::now()->format('Y-m-d H:i:s');

        $model->update([
            'date' => $validatedData['date'],
            'time_start' => Carbon::parse("{$validatedData['date']} {$validatedData['time_start']}")->format('Y-m-d H:i:s'),
            'time_end' => Carbon::parse("{$validatedData['date']} $time_end")->format('Y-m-d H:i:s'),
//            'time_start' => $validatedData['time_start'],
//            'time_end' => $time_end,
            'description' => $validatedData['description'],
            'duration' => $duration,
            'type_id' => $type_id,
            'status_id' => $validatedData['status_id'],
            'departure_gate_id' => $validatedData['gate_id'],
            'arrival_gate_id' => $validatedData['gate_id'],
            'people_limit' => $validatedData['people_limit'],
            'cost' => $validatedData['cost'],
            'created_at' => $date,
            'updated_at' => $date
        ]);

        return back()
            ->withInput($validatedData)
            ->with('success', 'Record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $model = Events::find($id);

        if ($model) {
            $model->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $model->save();
        }

        return back()
            ->with('success', 'Record deleted');
    }
}
