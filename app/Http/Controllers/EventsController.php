<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Destinations;
use App\Models\Events;
use App\Models\Gates;
use App\Models\Settings;
use App\Models\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Class EventsController
 * @package App\Http\Controllers
 */
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * пока что без пагинации, для фильтрованных задач не отрабатывает смена страниц
     * нужно более делатьно разбираться с визуалом таблицы
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pause = Settings::whereParameter('pause')->first();
        $statuses = Statuses::with('translationEn')->get();
        $destinations = Destinations::with('translationEn')->get();
        $range = is_null($pause) ? 5 : $pause->value;
        $filters = [];

        $records = Events::whereBetween('date', [
                Carbon::now()->format('Y-m-d'),
                Carbon::now()->addDays(7)->format('Y-m-d')
            ])
            ->with('typeEn', 'statusEn', 'departureGateEn', 'destinationEn')
            ->orderBy('date', 'ASC')
            ->orderBy('time_start', 'ASC')
            ->get();

        return view('events.index', compact('records', 'range', 'statuses', 'destinations', 'filters'));
    }

    /**
     * пока что без пагинации, для фильтрованных задач не отрабатывает смена страниц
     * нужно более делатьно разбираться с визуалом таблицы
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFiltered(Request $request)
    {
        $filters = $request->all();
        $pause = Settings::whereParameter('pause')->first();
        $statuses = Statuses::with('translationEn')->get();
        $destinations = Destinations::with('translationEn')->get();
        $range = is_null($pause) ? 5 : $pause->value;

        // такой метод не работает
//        $records = Events::with('typeEn', 'statusEn', 'departureGateEn', 'destinationEn')
//            ->orderBy('date', 'ASC')
//            ->orderBy('time_start', 'ASC');
//
//        if (isset($filters['date_start'])) {
//            $records->where('date', '>=', Carbon::parse($filters['date_start'])->format('Y-m-d'));
//        }
//
//        if (isset($filters['date_end'])) {
//            $records->where('date', '<=', Carbon::parse($filters['date_end'])->format('Y-m-d'));
//        }
//
//        if (isset($filters['status_id'])) {
//            $records->whereIn('status_id', $filters['status_id']);
//        }
//
//        $records->paginate(5);

        $records = Events::whereIn('status_id', $filters['status_id'])
            ->whereIn('destination_id', $filters['destination_id'])
            ->whereBetween('date', [
                Carbon::parse($filters['date_start'])->format('Y-m-d'),
                Carbon::parse($filters['date_end'])->format('Y-m-d')
            ])
            ->with('typeEn', 'statusEn', 'departureGateEn', 'destinationEn')
            ->orderBy('date', 'ASC')
            ->orderBy('time_start', 'ASC')
            ->get();

        return view('events.index', [
            'records' => $records,
            'range' => $range,
            'statuses' => $statuses,
            'destinations' => $destinations,
            'filters' => $filters
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
            ->with('type', 'status', 'departureGate', 'destination')
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
            ->with('type', 'status', 'departureGate', 'destination')
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
        $destinations = Destinations::with('translationEn')->get();

        return view('events.create', compact('categories', 'gates', 'destinations'));
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
            'destination_id' => 'nullable|integer|exists:destinations,id',
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
            'date' => Carbon::parse($validatedData['date'])->format('Y-m-d'),
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
            'destination_id' => $validatedData['destination_id'],
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
            ->with('typeEn', 'statusEn', 'departureGateEn', 'destinationEn')
            ->first();
        $categories = Categories::with(['typesEn.subtypesEn'])->get();
        $gates = Gates::with('translationEn')->get();
        $statuses = Statuses::with('translationEn')->get();
        $destinations = Destinations::with('translationEn')->get();

        return view('events.edit', compact('event', 'categories', 'gates', 'statuses', 'destinations'));
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
            'destination_id' => 'nullable|integer|exists:destinations,id',
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
            'date' => Carbon::parse($validatedData['date'])->format('Y-m-d'),
            'time_start' => Carbon::parse("{$validatedData['date']} {$validatedData['time_start']}")->format('Y-m-d H:i:s'),
            'time_end' => Carbon::parse("{$validatedData['date']} $time_end")->format('Y-m-d H:i:s'),
//            'time_start' => $validatedData['time_start'],
//            'time_end' => $time_end,
            'description' => $validatedData['description'],
            'duration' => $duration,
            'type_id' => $type_id,
            'status_id' => $validatedData['status_id'],
            'departure_gate_id' => $validatedData['gate_id'],
            'destination_id' => $validatedData['destination_id'],
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
