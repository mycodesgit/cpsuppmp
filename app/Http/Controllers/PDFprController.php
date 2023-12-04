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
        $pdf = PDF::loadView('request.forms.prTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFbarsRead() {
        return view('request.forms.BARSFormTemplate');
    }
    
    public function PDFbarsShowTemplate() {
        $pdf = PDF::loadView('request.forms.barsTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
