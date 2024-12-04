<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Facilities;
use App\Models\Materials;
use App\Models\Translations;
use App\Models\TypeFacilities;
use App\Models\TypeMaterials;
use App\Models\Types;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class TypesController
 * @package App\Http\Controllers
 */
class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types.index', [
            'records' => Types::with('categoryEn', 'nameTranslationEn', 'descrTranslationEn', 'subtypesEn')
                ->whereParentId(0)
                ->orderBy('id', 'ASC')
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::with('translationEn')->get();
        $types = Types::with('nameTranslationEn')->get();
        $materials = Materials::with('translationEn')->get();
        $facilities = Facilities::with('translationEn')->get();

        return view('types.create', compact('categories', 'types', 'materials', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = $request->post();
        $validatedData = $request->validate([
            'i18n_category_code' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_duration_hours' => 'nullable|integer|min:0',
            'default_duration_minutes' => 'nullable|integer|min:0|max:59',
            'default_cost' => 'nullable|numeric|min:0',
            'default_participants_number' => 'nullable|integer|min:0',
            'material_ids' => 'nullable|array',
            'material_ids.*' => 'exists:materials,id',
            'facility_ids' => 'array',
            'facility_ids.*' => 'exists:facilities,id',
            'subtypes' => 'nullable|array',
            'subtypes.*.name' => 'required|string|max:255',
            'subtypes.*.description' => 'required|string',
            'subtypes.*.default_duration_hours' => 'required|integer|min:0',
            'subtypes.*.default_duration_minutes' => 'required|integer|min:0|max:59',
            'subtypes.*.default_cost' => 'nullable|numeric|min:0',
            'subtypes.*.default_participants_number' => 'nullable|integer|min:0'
        ]);

        $lastTranslationId = Types::max('id') + 1;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        // переводы для основного типа
        $translations = [
            ['locale_id' => 1, 'code' => "type_name_$lastTranslationId", 'text' => $array['name'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => "type_name_$lastTranslationId", 'text' => $array['name'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => "type_name_$lastTranslationId", 'text' => $array['name'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 1, 'code' => "type_description_$lastTranslationId", 'text' => $array['description'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => "type_description_$lastTranslationId", 'text' => $array['description'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => "type_description_$lastTranslationId", 'text' => $array['description'], 'created_at' => $date, 'updated_at' => $date]
        ];

        $array['i18n_name_code'] = "type_name_$lastTranslationId";
        $array['i18n_description_code'] = "type_description_$lastTranslationId";

        $hours = $validatedData['default_duration_hours'] ?? 0;
        $minutes = $validatedData['default_duration_minutes'] ?? 0;

        $array['default_duration'] = ($hours * 60) + $minutes;

        Translations::insert($translations);

        $type = Types::create($array);

        if (isset($array['subtypes'])) {
            Log::info(json_encode($array['subtypes']));
            $lastSubtypeId = $lastTranslationId + 1;

            foreach ($array['subtypes'] as $subtype) {
                $translations = [
                    ['locale_id' => 1, 'code' => "type_name_$lastSubtypeId", 'text' => $subtype['name'], 'created_at' => $date, 'updated_at' => $date],
                    ['locale_id' => 2, 'code' => "type_name_$lastSubtypeId", 'text' => $subtype['name'], 'created_at' => $date, 'updated_at' => $date],
                    ['locale_id' => 3, 'code' => "type_name_$lastSubtypeId", 'text' => $subtype['name'], 'created_at' => $date, 'updated_at' => $date],
                    ['locale_id' => 1, 'code' => "type_description_$lastSubtypeId", 'text' => $subtype['description'], 'created_at' => $date, 'updated_at' => $date],
                    ['locale_id' => 2, 'code' => "type_description_$lastSubtypeId", 'text' => $subtype['description'], 'created_at' => $date, 'updated_at' => $date],
                    ['locale_id' => 3, 'code' => "type_description_$lastSubtypeId", 'text' => $subtype['description'], 'created_at' => $date, 'updated_at' => $date]
                ];

                Translations::insert($translations);

                $hours = $subtype['default_duration_hours'] ?? 0;
                $minutes = $subtype['default_duration_minutes'] ?? 0;

                $newSubtype = Types::create([
                    'i18n_category_code' => $array['i18n_category_code'],
                    'parent_id' => $type->id,
                    'i18n_name_code' => "type_name_$lastSubtypeId",
                    'i18n_description_code' => "type_description_$lastSubtypeId",
                    'default_participants_number' => $subtype['default_participants_number'],
                    'default_duration' => ($hours * 60) + $minutes,
                    'default_cost' => $subtype['default_cost']
                ]);

                if (isset($subtype['material_ids'])) {
                    $newSubtype->materials()->sync($subtype['material_ids']);
                }

                if (isset($subtype['facility_ids'])) {
                    Log::info(json_encode($subtype['facility_ids']));

                    try {
                        $newSubtype->facilities()->sync($subtype['facility_ids']);
                    } catch (Exception $exception) {
                        Log::info($exception->getMessage());
                    }
                }

                $lastSubtypeId++;
            }
        }

        if (isset($validatedData['material_ids'])) {
            $type->materials()->sync($validatedData['material_ids']);
        }

        if (isset($validatedData['facility_ids'])) {
            $type->facilities()->sync($validatedData['facility_ids']);
        }

        return back()
            ->withInput($validatedData)
            ->with('success', 'Record Created-');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = Categories::all();
        $materials = Materials::with('translationEn')->get();
        $facilities = Facilities::with('translationEn')->get();
        $type = Types::whereId($id)
            ->with(
                'categoryEn', 'nameTranslationEn', 'descrTranslationEn'
                , 'subtypesEn', 'facilities', 'materials'
            )
            ->first();

        return view('types.edit', compact('type', 'categories', 'materials', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $array = $request->post();
        $validatedData = $request->validate([
            'i18n_category_code' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_duration_hours' => 'nullable|integer|min:0',
            'default_duration_minutes' => 'nullable|integer|min:0|max:59',
            'default_cost' => 'nullable|numeric|min:0',
            'default_participants_number' => 'nullable|integer|min:0',
            'material_ids' => 'nullable|array',
            'material_ids.*' => 'exists:materials,id',
            'facility_ids' => 'array',
            'facility_ids.*' => 'exists:facilities,id',
            'subtypes' => 'nullable|array',
            'subtypes.*.name' => 'required|string|max:255',
            'subtypes.*.description' => 'required|string',
            'subtypes.*.default_duration_hours' => 'required|integer|min:0',
            'subtypes.*.default_duration_minutes' => 'required|integer|min:0|max:59',
            'subtypes.*.default_cost' => 'nullable|numeric|min:0',
            'subtypes.*.default_participants_number' => 'nullable|integer|min:0'
        ]);

        $date = Carbon::now()->format('Y-m-d H:i:s');

        $model = Types::whereId($id)
            ->with('nameTranslationEn', 'descrTranslationEn', 'facilities', 'materials')
            ->first();

        $hours = $validatedData['default_duration_hours'] ?? 0;
        $minutes = $validatedData['default_duration_minutes'] ?? 0;

        $model->update([
            'default_duration' => ($hours * 60) + $minutes,
            'default_cost' => $validatedData['default_cost'],
            'default_participants_number' => $validatedData['default_participants_number'],
            'updated_at' => $date
        ]);

        $model->nameTranslationEn->update([
            'text' => $array['name'],
            'updated_at' => $date
        ]);

        $model->descrTranslationEn->update([
            'text' => $array['description'],
            'updated_at' => $date
        ]);

        // Массив для отслеживания подтипов, которые нужно оставить (обновить или добавить)
        $updatedSubtypeIds = [];

        if (isset($array['subtypes'])) {
            foreach ($validatedData['subtypes'] as $subtypeData) {
                $hours = $subtypeData['default_duration_hours'] ?? 0;
                $minutes = $subtypeData['default_duration_minutes'] ?? 0;
                $subtypeDurationInMinutes = ($hours * 60) + $minutes;

                if (isset($subtypeData['id'])) {
                    $subtype = Types::whereId($subtypeData['id'])
                        ->with('nameTranslationEn', 'descrTranslationEn')
                        ->first();

                    $subtype->nameTranslationEn->update([
                        'text' => $subtypeData['name'],
                        'updated_at' => $date
                    ]);

                    $subtype->descrTranslationEn->update([
                        'text' => $subtypeData['description'],
                        'updated_at' => $date
                    ]);

                    $subtype->update([
                        'default_duration' => $subtypeDurationInMinutes,
                        'default_cost' => $subtypeData['default_cost'],
                        'default_participants_number' => $subtypeData['default_participants_number'],
                        'updated_at' => $date
                    ]);

                    $subtype->materials()->sync($subtypeData['material_ids']);
                    $subtype->facilities()->sync($subtypeData['facility_ids']);

                    $updatedSubtypeIds[] = $subtype->id;
                } else {
                    $lastSubtypeTranslationId = Types::max('id') + 1;

                    $translations = [
                        ['locale_id' => 1, 'code' => "type_name_$lastSubtypeTranslationId", 'text' => $subtypeData['name'], 'created_at' => $date, 'updated_at' => $date],
                        ['locale_id' => 2, 'code' => "type_name_$lastSubtypeTranslationId", 'text' => $subtypeData['name'], 'created_at' => $date, 'updated_at' => $date],
                        ['locale_id' => 3, 'code' => "type_name_$lastSubtypeTranslationId", 'text' => $subtypeData['name'], 'created_at' => $date, 'updated_at' => $date],
                        ['locale_id' => 1, 'code' => "type_description_$lastSubtypeTranslationId", 'text' => $subtypeData['description'], 'created_at' => $date, 'updated_at' => $date],
                        ['locale_id' => 2, 'code' => "type_description_$lastSubtypeTranslationId", 'text' => $subtypeData['description'], 'created_at' => $date, 'updated_at' => $date],
                        ['locale_id' => 3, 'code' => "type_description_$lastSubtypeTranslationId", 'text' => $subtypeData['description'], 'created_at' => $date, 'updated_at' => $date]
                    ];

                    Translations::insert($translations);

                    $newSubtype = Types::create([
                        'i18n_category_code' => $model->i18n_category_code,
                        'parent_id' => $model->id,
                        'i18n_name_code' => "type_name_$lastSubtypeTranslationId",
                        'i18n_description_code' => "type_description_$lastSubtypeTranslationId",
                        'default_participants_number' => $subtypeData['default_participants_number'],
                        'default_duration' => $subtypeDurationInMinutes,
                        'default_cost' => $subtypeData['default_cost'],
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);

                    if (isset($subtype['material_ids'])) {
                        $newSubtype->materials()->sync($subtypeData['material_ids']);
                    }

                    if (isset($subtype['facility_ids'])) {
                        $newSubtype->facilities()->sync($subtypeData['facility_ids']);
                    }

                    $updatedSubtypeIds[] = $newSubtype->id;
                }
            }
        }

//        $model->materials()->sync($validatedData['material_ids']);
//
//        $model->facilities()->sync($validatedData['facility_ids']);

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
        $model = Types::whereId($id)
            ->with('nameTranslationEn', 'descrTranslationEn',
                'nameTranslationRu', 'descrTranslationRu',
                'nameTranslationGr', 'descrTranslationGr', 'subtypesEn')
            ->first();
        $date = Carbon::now()->format('Y-m-d H:i:s');

        if ($model) {
            $model->nameTranslationEn->update([
                'deleted_at' => $date
            ]);

            $model->nameTranslationRu->update([
                'deleted_at' => $date
            ]);

            $model->nameTranslationGr->update([
                'deleted_at' => $date
            ]);

            $model->descrTranslationEn->update([
                'deleted_at' => $date
            ]);

            $model->descrTranslationRu->update([
                'deleted_at' => $date
            ]);

            $model->descrTranslationGr->update([
                'deleted_at' => $date
            ]);

            $model->subtypesEn()->update([
                'deleted_at' => $date
            ]);

            $model->update([
                'deleted_at' => $date
            ]);
        }

        return back()
            ->with('success', 'Record deleted');
    }
}
