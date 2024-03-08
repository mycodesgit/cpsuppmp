<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\User;

trait ApprovedCountTrait
{
    public function getApprovedAllCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '7')
            ->count();
    }
    public function getApprovedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', '=', '7')
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }
}
