<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function Hello()
    {
        return view('Welcome');
    }
}
