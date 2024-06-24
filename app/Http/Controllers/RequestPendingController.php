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
use App\Traits\ApprovedCountTrait;

use App\Models\Campus;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\DocFile;
use App\Models\FundingSource;
use App\Models\PpmpVerify;
use App\Models\User;

class RequestPendingController extends Controller
{   
    use PendingCountTrait;
    use ApprovedCountTrait;

    public function pendingListRead() 
    {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['2', '3', '4', '5', '6'])
            ->where('purpose.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
            ]);
        }

        return view ("request.pending.pendingListUser", compact('reqitempurpose', 'data'));
    }

    public function pendingAllListRead() {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['2', '3', '4', '5'])
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
            ]);
        }

        return view("request.pending.pendingListChecker", compact('reqitempurpose', 'data'));
    }

    public function pendingAllBudgetListRead() {
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['6'])
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
            ]);
        }

        return view("request.pending.pendingListBud", compact('reqitempurpose', 'data'));
    }

    public function getpendingListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->whereIn('purpose.pstatus', ['2', '3', '4', '5', '6'])
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getpendingAllListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->whereIn('purpose.pstatus', ['2', '3', '4', '5'])
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getpendingBudgetAllListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['6'])
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

        $docFile = DocFile::where('purpose_id', $enID)->first();

        $pendItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('ppmpverify', 'purpose.id', '=', 'ppmpverify.purpose_id')
            ->select('item_request.*', 'item_request.updated_at as itemrq_updated_at',
                    'category.*',
                    'ppmpverify.*',
                    'purpose.*', 'purpose.id as puid', 'purpose.created_at as purpose_created_at', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data', 'docFile'));
    }

    public function pendingAllListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $docFile = DocFile::where('purpose_id', $enID)->first();

        $pendItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('ppmpverify', 'purpose.id', '=', 'ppmpverify.purpose_id')
            ->select('item_request.*', 
                    'category.*',
                    'ppmpverify.*',
                    'ppmpverify.ppmp_remarks',
                    'purpose.*', 'purpose.id as puid', 'purpose.created_at as purpose_created_at', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data', 'docFile'));
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
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
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
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.pending.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFrbarasPending($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('funding_source', 'item_request.purpose_id', '=', 'funding_source.purpose_id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->join('campuses', 'item_request.campid', '=', 'campuses.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'purpose.created_at as pur_created_at',
                    'office.*',
                    'campuses.*', 
                    'users.*', 
                    'funding_source.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'funding_source.id as fid',
                    'office.id as oid',
                    'campuses.id as cid' )
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
            'purpose' => $purpose,
        ];

        $pdf = PDF::loadView('request.pending.rbarcspdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFrbarasAllPending($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('funding_source', 'item_request.purpose_id', '=', 'funding_source.purpose_id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->join('campuses', 'item_request.campid', '=', 'campuses.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'purpose.created_at as pur_created_at',
                    'office.*', 
                    'campuses.*',
                    'users.*',
                    'funding_source.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'office.id as oid',
                    'funding_source.id as fid',
                    'campuses.id as cid' )
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.pending.rbarcspdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function checkingPR(Request $request) {
        // $userId = Auth::id();
        $purpose_id = decrypt($request->input('purpose_id'));
        $status = $request->input('status');
        $ppmpRemarks = $request->input('ppmp_remarks');
        $prstatus = $request->input('prstatus');

        RequestItem::where('purpose_id', $purpose_id)
            ->update(['status' => $status]);

        Purpose::where('id', $purpose_id)
            ->update(['pstatus' =>  $status]);

        PpmpVerify::where('purpose_id', $purpose_id)
            ->update([
                    'ppmp_remarks' => $ppmpRemarks,
                    'prstatus' => $prstatus,
            ]);

        return back()->with('success', 'Save Successfully');
    }

    public function approvedPR(Request $request) {
        // $userId = Auth::id();
        $purpose_id = decrypt($request->input('purpose_id'));
        $status = $request->input('status');
        $financing_source = $request->input('financing_source');
        $fund_cluster = $request->input('fund_cluster');
        $fund_category = $request->input('fund_category');
        $fund_auth = $request->input('fund_auth');
        $specific_fund = $request->input('specific_fund');
        $reason = $request->input('reason');
        $allotment = $request->input('allotment');
        $account_code = $request->input('account_code');
        $amount = $request->input('amount');
        $purproject = $request->input('purproject');
        $progactproject = $request->input('progactproject');
        $allotbuget = $request->input('allotbuget');

        RequestItem::where('status', 6)
            ->where('purpose_id', $purpose_id)
            ->update(['status' => $status]);

        Purpose::where('id', $purpose_id)
            ->update(['pstatus' =>  7]);

        FundingSource::where('purpose_id', $purpose_id)
            ->update([
                    'financing_source' => $financing_source,
                    'fund_cluster' => $fund_cluster,
                    'fund_category' => $fund_category,
                    'fund_auth' => $fund_auth,
                    'specific_fund' => $specific_fund,
                    'reasons' => $reason,
                    'allotment' => $allotment,
                    'account_code' => $account_code,
                    'amount' => $amount,
                    'purproject' => $purproject,
                    'progactproject' => $progactproject,
                    'allotbuget' => $allotbuget,
            ]);
        $year = Carbon::now()->format('Y');
        $prnumber = '';
        $latestPrnumber = Purpose::where('pr_no', 'like', $year . '-%' . '-' . $fund_cluster)->latest('created_at')->first();

        if (empty($latestPrnumber)) {
            $latestId = 0;
        } else {
            $latestId = (int)substr($latestPrnumber->pr_no, -4);
        }

        $newPrId = $latestId + 1;
        $paddedValue = str_pad($newPrId, 4, '0', STR_PAD_LEFT);
        $prnumber = $year . '-' . $paddedValue . '-' . $fund_cluster;

        Purpose::where('id', $purpose_id)
            ->update(['pr_no' => $prnumber]);

        return back()->with('success', 'Save Successfully');
    }

}
