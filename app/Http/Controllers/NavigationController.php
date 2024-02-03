<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function dashboard()
    {
        return inertia('Dashboard');
    }

    public function apps()
    {
        return inertia('Apps');
    }
}
