<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function log()
    {
        $logs = LogActivity::all();
        return view('admin.log', compact('logs'));
    }
}
