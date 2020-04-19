<?php


namespace App\Http\Controllers;


use App\User;
use http\Env\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function userDetails($id){
        return response()->json(['user'=> User::findOrFail($id)]);
    }
}
