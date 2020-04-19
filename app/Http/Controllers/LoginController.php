<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function listUser(Request $request){


        return response()->json(['user'=>User::all()]);
    }
}
