<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function index()
    {
        $data = Setting::where('id',1)->first();

        return response()->json(['success'=>true,$data]);
    }
}
