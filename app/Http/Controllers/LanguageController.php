<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function __invoke($language)
    {
        // Check if the selected language is in the supported locales
        if (in_array($language, config('app.locales'))) {
            // Set the application locale
            App::setLocale($language);

            // Store the selected language in the session
            session(['locale' => $language]);
        }

        // Redirect back or to a specific route
        return redirect()->back();
    }
}