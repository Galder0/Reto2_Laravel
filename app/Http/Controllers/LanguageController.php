<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLang($language)
    {
        // Get the supported locales from the configuration
        $supportedLocales = config('app.locales');

        // Check if the supported locales is an array
        if (is_array($supportedLocales) && in_array($language, $supportedLocales)) {
            // Set the application locale
            App::setLocale($language);

            // Store the selected language in the session
            session(['locale' => $language]);
        }

        // Redirect back or to a specific route
        return redirect()->back();
    }
}