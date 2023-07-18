<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Office;
use App\Models\Campus;
use App\Models\User;


class MasterController extends Controller
{
    //
    public function dashboard(){
        $camp = Campus::all();
        $userCount = User::count();
        $campusCount = Campus::count();
        return view("home.dashboard", compact('camp', 'userCount', 'campusCount'));
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
