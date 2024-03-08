<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\FundingSource;
use App\Models\User;
use App\Models\PpmpUser;

class PpmpController extends Controller
{
    public function ppmpRead() {
        $categories = Category::all();

        $userppmp = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->leftJoin('ppmpuser', 'users.id', '=', 'ppmpuser.user_id')
            ->select('users.id as uid', 'users.*', 'campuses.*', 'office.*', 'ppmpuser.*')
            ->get();
        
        return view ("ppmp.list_officeppmp", compact('categories', 'userppmp'));
    }

    public function ppmpEdit($uid) {
        $userppmp = PpmpUser::findOrFail($uid);
        $categories = Category::all();

        return view('ppmp.list_officeppmp', compact('userppmp', 'categories'));
    }

    public function userppmpUpdate(Request $request) {
        $request->validate([
            'ppmp_categories' => 'required',
        ]);

        try {
            $userppmp = PpmpUser::findOrFail($request->input('user_id'));
            $userppmp->update([
                'ppmp_categories' => $request->input('ppmp_categories')
            ]);

            return redirect()->route('ppmpRead')->with('success', 'Add successfully!');
        } catch (\Exception $e) {
            return redirect()->route('ppmpRead')->with('error', 'Failed to store!');
        }
    }
}
