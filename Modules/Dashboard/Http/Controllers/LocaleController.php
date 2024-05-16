<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale)
    {
        Session::put('locale', $locale);

        if (auth()->check()) {
            auth()->user()->update([
                'preferred_locale' => $locale,
            ]);
        }

        return back();
    }
}
