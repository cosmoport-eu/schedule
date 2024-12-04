<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use Illuminate\Http\Request;

/**
 * Class LocalesController
 * @package App\Http\Controllers
 */
class LocalesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAll(Request $request)
    {
        foreach ($request->post('locales') as $id => $data) {
            $data['is_default'] = isset($data['is_default']);

            $locale = Locales::find($id);

            if ($locale) {
                $locale->update($data);
            }
        }

        return back()
            ->with('success', 'Success');
    }
}
