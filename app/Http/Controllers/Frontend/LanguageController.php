<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change language to Hindi
     */
    public function hindi()
    {
        # get session
        Session::get('language');

        # forget session
        Session::forget('language');

        # set session
        Session::put('language', 'hindi');

        # redirect to home page
        return redirect()->back();
    }

    /**
     * Change language to English
     */
    public function english()
    {
        # get session
        Session::get('language');
        
        # forget session
        Session::forget('language');

        # set session
        Session::put('language', 'english');

        # redirect to home page
        return redirect()->back();
    }
}
