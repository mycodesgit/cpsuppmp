<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use App\Traits\PendingCountTrait;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\User;

class RequestApprovedController extends Controller
{
    use PendingCountTrait;
    
    public function approvedListRead() {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '4')
            ->where('purpose.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        return view ("request.approved.approvedList", compact('reqitempurpose', 'data'));
    }

    public function approvedListAllRead() {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '4')
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        return view ("request.approved.approvedList", compact('reqitempurpose', 'data'));
    }

    public function approvedListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $appItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('item_request.*', 
                    'category.*',
                    'purpose.*', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->where('item_request.status', '=', '4')
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        return view ("request.approved.viewlist", compact('category', 'unit', 'item', 'appItem', 'purpose'));
    }

    public function PDFprApproved($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'office.*', 
                    'users.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'office.id as oid' )
            ->where('item_request.status', '=', '4')
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.approved.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
