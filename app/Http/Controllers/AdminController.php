<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $level = session('level');

        return view('admin.'. $level . '.index');
    }

    public function users()
    {
        $level = session('level');

        return view('admin.'. $level . '.user');
    }

}
