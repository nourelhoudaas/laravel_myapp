<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LanguageControll extends Controller
{
    public function changeLanguage($lang)
    {
        // Set the locale
        App::setLocale($lang);
        
        // Store the locale in session or cookie if needed
        session(['locale' => $lang]);
        
        // Redirect back to the previous page
        return redirect()->back();
    }
}
