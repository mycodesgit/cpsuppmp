<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class PDFprController extends Controller
{
    public function PDFprRead() {
        return view('request.PRFormTemplate');
    }

    public function PDFprShowTemplate() {
        $pdf = PDF::loadView('request.prTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
