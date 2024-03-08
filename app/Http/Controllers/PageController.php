<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function chart()
    {
        return view('admin.chart');
    }

    public function tables()
    {
        return view('admin.tables');
    }
}
