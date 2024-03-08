<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;

class ItemController extends Controller
{
    public function itemRead() {
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::join('unit', 'item.unit_id', '=', 'unit.id')
                ->join('category', 'item.category_id', '=', 'category.id')
                ->get();

        return view('manage.item', compact('category', 'unit', 'item'));
    }

    public function itemCreate(Request $request) {
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

                return redirect()->route('itemRead')->with('success', 'Item stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('itemRead')->with('error', 'Failed to store Item!');
            }
        }
    }

    public function itemEdit($id) {
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::join("category", "item.category_id", "=", "category.id")
            ->select('item.*', 'category.category_name', 'item.id as itemID')
            ->get();

        $editItem = Item::join("category", "item.category_id", "=", "category.id")
            ->select('item.*', 'category.category_name', 'item.id as itemID')
            ->where('item.id', $id)
            ->first();

        return view("manage.item", compact('category', 'item', 'editItem', 'unit'));
    }

    public function itemUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'item_name' => 'required',
            'item_descrip' => 'required',
            'item_cost' => 'required',
        ]);

        try {
            $itemName = $request->input('item_name');
            $existingItem = Item::where('item_name', $itemName)->where('id', '!=', $request->input('id'))->first();

            if ($existingItem) {
                return redirect()->back()->with('error', 'Item already exists!');
            }

            $item = Item::findOrFail($request->input('id'));
            $item->update([
                'category_id' => $request->input('category_id'),
                'unit_id' => $request->input('unit_id'),
                'item_name' => $itemName,
                'item_descrip' => $request->input('item_descrip'),
                'item_cost' => $request->input('item_cost'),
        ]);

            return redirect()->route('itemEdit', ['id' => $item->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Category!');
        }
    }

    public function itemDelete($id) {
        $item = Item::find($id);
        $item->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}
