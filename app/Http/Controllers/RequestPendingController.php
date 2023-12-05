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

class RequestPendingController extends Controller
{   
    use PendingCountTrait;

    public function pendingListRead() 
    {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '2')
            ->where('purpose.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        if (request()->ajax()) {
            return response()->json(['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount]);
        }

        return view ("request.pending.pendingList", compact('reqitempurpose', 'data'));
    }

    public function pendingAllListRead() {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '2')
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        if (request()->ajax()) {
            return response()->json(['pendCount' => $pendCount]);
        }

        return view("request.pending.pendingList", compact('reqitempurpose', 'data'));
    }

    public function getpendingAllListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '2')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }


    public function pendingListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $pendItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('item_request.*', 
                    'category.*',
                    'purpose.*', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->where('item_request.status', '=', ['2', '3'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        return view ("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data'));
    }

    public function pendingAllListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $pendItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('item_request.*', 
                    'category.*',
                    'purpose.*', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->where('item_request.status', '=', ['2', '3'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = ['pendCount' => $pendCount, 'pendUserCount' => $pendUserCount];

        return view ("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data'));
    }

    public function PDFprPending($pid) {
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
            ->where('item_request.status', '=', ['2', '3'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.pending.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFprAllPending($pid) {
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
            ->where('item_request.status', '=', ['2', '3'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.pending.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function approvedPR(Request $request) {
        // $userId = Auth::id();
        $purpose_id = decrypt($request->input('purpose_id'));
        $status = $request->input('status');

        RequestItem::where('status', 2)
            ->where('purpose_id', $purpose_id)
            ->update(['status' => $status]);

        Purpose::where('id', $purpose_id)
            ->update(['pstatus' =>  $status]);

        return back()->with('success', 'Save Successfully');
    }

}
