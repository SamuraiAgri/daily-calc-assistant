<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    // ホームページの表示
    public function index()
    {
        $agent = new Agent();

        if ($agent->isMobile()) {
            // モバイル版のBladeを返す
            return view('home_mobile', ['agent' => $agent]);
        } else {
            // デスクトップ版のBladeを返す
            return view('home', ['agent' => $agent]);
        }
    }
}
