<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;

class RequestController extends Controller
{
    //
    public function pendingListRead() {
        return view ("request.pendingList");
    }

    public function approvedListRead() {
        return view ("request.approvedList");
    }

    public function prCreate() {
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();
        return view ("request.add_newpr", compact('category', 'unit', 'item'));

        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'required',
                'unit_id' => 'required',
                'item_name' => 'required',
                'item_descrip' => 'required',
                'item_cost' => 'required',
            ]);

            try {
                Item::create([
                    'category_id' => $request->input('category_id'),
                    'unit_id' => $request->input('unit_id'),
                    'item_name' => $request->input('item_name'),
                    'item_descrip' => $request->input('item_descrip'),
                    'item_cost' => $request->input('item_cost'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('prCreate')->with('success', 'Item add successfully!');
            } catch (\Exception $e) {
                return redirect()->route('prCreate')->with('error', 'Failed to add Item!');
            }
        }
    }

    public function getItemsByCategory($id) {
        if ($id) {
            $items = Item::where('category_id', $id)
                ->select('item_name', 'item_descrip', 'item_cost', 'id')
                ->get();

            $options = "";
            foreach ($items as $item) {
                $options .= "<option value='".$item->id."'  data-item-id='".$item->id."' data-item-cost='".$item->item_cost."'>".$item->item_name. ' ' .$item->item_descrip."</option>";
            }
        } else {
            $options = "<option value=''>Select a category first</option>";
        }

        return response()->json([
            "options" => $options,
        ]);
    }
}
