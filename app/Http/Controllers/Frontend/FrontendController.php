<?php

namespace App\Http\Controllers\Frontend;

use App\InviteCode;
use App\Http\Controllers\Controller;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        javascript()->put([
            'test' => 'it works!',
        ]);

        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function client()
    {
        return view('frontend.client');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function code()
    {
        $codes = InviteCode::getPublicCode();
        return view('frontend.code', ['codes' => $codes]);
    }
}
