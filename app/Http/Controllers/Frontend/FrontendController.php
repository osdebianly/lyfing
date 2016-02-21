<?php

namespace App\Http\Controllers\Frontend;

use App\Models\InviteCode;
use App\Models\Access\User\User;
use App\Helpers\Tools;
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
        $server_ip = Tools::getCurrentServerIP();
        $publicUser = User::where('email', 'admin@admin.com')->first();
        $ssContent = $publicUser->method . ':' . $publicUser->passwd . '@' . $server_ip . ':' . $publicUser->port;
        $publicSS = "ss://" . base64_encode($ssContent);
        return view('frontend.index', ['publicSS' => $publicSS, 'user' => $publicUser]);
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
