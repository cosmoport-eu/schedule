<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index', [
            'locales' => Locales::all(),
            'pause' => Settings::whereParameter('pause')->first(),
            'timetable_screen_lines' => Settings::whereParameter('timetable_screen_lines')->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $parameter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $parameter)
    {
        $validatedData = $request->validate([
            'pause' => 'nullable|string|min:1|max:55',
            'timetable_screen_lines' => 'nullable|string|min:1'
        ]);

        $model = Settings::whereParameter($parameter)->first();

        $model->update([
            'value' => $request->post($parameter),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return back()
            ->withInput($validatedData)
            ->with('success', 'Success');
    }
}
