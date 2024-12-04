<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Destinations;
use App\Models\Facilities;
use App\Models\Gates;
use App\Models\InterfaceElements;
use App\Models\Materials;
use App\Models\Statuses;
use App\Models\Translations;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Class DictionaryController
 * @package App\Http\Controllers
 */
class DictionaryController extends Controller
{
    /**
     * @var array
     */
    protected $typeData = [
        'statuses' => [
            'model' => Statuses::class,
            'is_icon_needed' => false,
            'is_deletable' => true
        ],
        'categories' => [
            'model' => Categories::class,
            'is_icon_needed' => false,
            'is_deletable' => true
        ],
        'destinations' => [
            'model' => Destinations::class,
            'is_icon_needed' => false,
            'is_deletable' => true
        ],
        'gates' => [
            'model' => Gates::class,
            'is_icon_needed' => false,
            'is_deletable' => true
        ],
        'facilities' => [
            'model' => Facilities::class,
            'is_icon_needed' => true,
            'is_deletable' => true
        ],
        'materials' => [
            'model' => Materials::class,
            'is_icon_needed' => true,
            'is_deletable' => true
        ],
        'interface-elements' => [
            'model' => InterfaceElements::class,
            'is_icon_needed' => false,
            'is_deletable' => false
        ]
    ];

    /**
     * @param $type
     * @return mixed
     */
    protected function getTypeData($type)
    {
        if (!array_key_exists($type, $this->typeData)) {
            abort(404, 'Type data not found');
        }

        return $this->typeData[$type];
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return \Illuminate\Contracts\View\View
     */
    public function index($type)
    {
        $typeData = $this->getTypeData($type);
        $model = new $typeData['model'];

        $records = $model::with('translationEn', 'translationRu', 'translationGr')
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return view('dictionary.index', [
            'records' => $records,
            'type' => $type,
            'is_icon_needed' => $typeData['is_icon_needed'],
            'is_deletable' => $typeData['is_deletable']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return \Illuminate\Contracts\View\View
     */
    public function create($type)
    {
        $typeData = $this->getTypeData($type);

        return view('dictionary.create', [
            'type' => $type,
            'is_icon_needed' => $typeData['is_icon_needed'],
            'is_deletable' => $typeData['is_deletable']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $type)
    {
        $typeData = $this->getTypeData($type);

        $validatedData = $request->validate([
            'english' => 'nullable|string',
            'russian' => 'nullable|string',
            'greek' => 'nullable|string',
        ], [
            'required_without_all' => 'Fill at least one field.',
        ]);

        if ($typeData['is_icon_needed']) {
            $request->validate([
                'icon' => 'required|string',
            ]);

            $validatedData['icon'] = $request->post('icon');
        }

        $firstValue = $validatedData['english'] ?? $validatedData['russian'] ?? $validatedData['greek'];

        // Заполнение полей, если значения не переданы
        foreach (['english', 'russian', 'greek'] as $lang) {
            $validatedData[$lang] = $validatedData[$lang] ?? $firstValue;
        }

        $model = new $typeData['model'];
        $lastTranslationId = $model::max('id') + 1;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $translations = [
            ['locale_id' => 1, 'code' => $type . '_' . $lastTranslationId, 'text' => $validatedData['english'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => $type . '_' . $lastTranslationId, 'text' => $validatedData['russian'], 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => $type . '_' . $lastTranslationId, 'text' => $validatedData['greek'], 'created_at' => $date, 'updated_at' => $date]
        ];

        Translations::insert($translations);

        $params = [
            'i18n_name_code' => $type . '_' . $lastTranslationId,
        ];

        if ($typeData['is_icon_needed']) {
            $params['icon'] = $validatedData['icon'];
        }

        $model::create($params);

        return back()
            ->withInput($validatedData)
            ->with('success', 'Data saved');
    }

    /**
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($type, $id)
    {
        $typeData = $this->getTypeData($type);
        $model = new $typeData['model'];
        $record = $model::whereId($id)
            ->with('translationEn', 'translationRu', 'translationGr')
            ->first();

        return view('dictionary.edit', [
            'item' => $record,
            'type' => $type,
            'is_icon_needed' => $typeData['is_icon_needed']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $type, $id)
    {
        $typeData = $this->getTypeData($type);

        $validatedData = $request->validate([
            'english' => 'nullable|string',
            'russian' => 'nullable|string',
            'greek' => 'nullable|string',
        ], [
            'required_without_all' => 'Fill at least one field.',
        ]);

        if ($typeData['is_icon_needed']) {
            $request->validate([
                'icon' => 'required|string',
            ]);

            $validatedData['icon'] = $request->post('icon');
        }

        $firstValue = $validatedData['english'] ?? $validatedData['russian'] ?? $validatedData['greek'];

        // Заполнение полей, если значения не переданы
        foreach (['english', 'russian', 'greek'] as $lang) {
            $validatedData[$lang] = $validatedData[$lang] ?? $firstValue;
        }
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $model = new $typeData['model'];
        $record = $model::whereId($id)
            ->with('translationEn', 'translationRu', 'translationGr')
            ->first();

        $translations = [
            'english' => $record->translationEn,
            'russian' => $record->translationRu,
            'greek' => $record->translationGr,
        ];

        foreach ($translations as $lang => $translation) {
            $translation->update([
                'text' => $validatedData[$lang],
                'updated_at' => $date
            ]);
        }

        if ($typeData['is_icon_needed']) {
            $record->update(['icon' => $validatedData['icon']]);
        }

        return back()
            ->withInput($validatedData)
            ->with('success', 'Record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($type, $id)
    {
        $typeData = $this->getTypeData($type);
        $model = new $typeData['model'];
        $record = $model::whereId($id)
            ->with('translationEn', 'translationRu', 'translationGr')
            ->first();
        $date = Carbon::now()->format('Y-m-d H:i:s');

        if ($record) {
            $record->translationEn->update([
                'deleted_at' => $date
            ])
            ;
            $record->translationRu->update([
                'deleted_at' => $date
            ]);

            $record->translationGr->update([
                'deleted_at' => $date
            ]);

            $record->update([
                'deleted_at' => $date
            ]);
        }

        return redirect()->route('dictionary.index', ['type' => $type, 'is_icon_needed' => $typeData['is_icon_needed']])
            ->with('success', 'Record deleted');
    }
}
