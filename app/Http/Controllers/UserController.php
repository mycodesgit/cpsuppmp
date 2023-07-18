<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campus;

class UserController extends Controller
{
    //
    public function user_list() {
        $camp = Campus::all();

        $user = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->select('users.id as uid', 'users.*', 'campuses.*')
            ->get();

        return view("users.list", compact('user', 'camp'));
    }

    public function user_settings() {
        return view("users.account_settings");
    }

}
