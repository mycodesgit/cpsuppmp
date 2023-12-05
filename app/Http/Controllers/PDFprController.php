<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Traits\PendingCountTrait;

class PDFprController extends Controller
{
    use PendingCountTrait;

    public function PDFprRead() {
        return view('request.PRFormTemplate');
    }

    public function PDFprShowTemplate() {
        $pdf = PDF::loadView('request.forms.prTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFbarsRead() {
        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        return view('request.forms.BARSFormTemplate', compact('data'));
    }
    
    public function PDFbarsShowTemplate() {
        $pdf = PDF::loadView('request.forms.barsTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
