<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{



    public function index(Request $request)
    {
        return view('dashboard.home');
    }
}
