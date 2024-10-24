<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class KontrolierisController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->limit(50)->get();
        return view('index', compact('users'));
    }
}
