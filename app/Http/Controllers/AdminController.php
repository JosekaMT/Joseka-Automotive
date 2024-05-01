<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function vehicle()
    {
        return view('admin.vehicle');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function notifications()
    {
        return view('admin.notifications');
    }

    public function vehicle2()
    {
        return view('admin.vehicle2');
    }
}