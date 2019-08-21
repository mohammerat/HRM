<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(Request $request)
    {
        return auth()->user();
    }
}
