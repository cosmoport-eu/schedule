<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use App\Models\Translations;
use Illuminate\Support\Facades\Log;

class TranslationsController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $data = collect();

        Locales::whereIsShown(true)
            ->get()
            ->each(function ($locale) use (&$data) {
                $data[$locale->code] = Translations::whereLocaleId($locale->id)->get();
            });

        return $data->toArray();
    }
}
