<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class UlitityRoomController extends Controller
{
    public function index(Request $request)
    {
        $configUlitity = Config::get('ulitity');
        return view('admin.page.ulitityroom.index', compact('configUlitity'));
    }
}
