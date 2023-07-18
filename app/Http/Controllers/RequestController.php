<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
    public function pending_list() {
        return view ("request.pendingList");
    }

    public function approved_list() {
        return view ("request.approvedList");
    }
}
