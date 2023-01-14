<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $titlePage = 'Home Page';
        return view('dashboard.home.index', compact('titlePage'));
    }

}
