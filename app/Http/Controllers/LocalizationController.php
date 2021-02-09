<?php
namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class LocalizationController extends Controller 
{
    public function lang_change($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);  
        return redirect()->back();
    }
}