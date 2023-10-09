<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Unit;

class UnitController extends Controller
{
    public function unitRead() {
        $unit = Unit::all();
        return view('manage.unit', compact('unit'));
    }

    public function unitCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'unit_name' => 'required',
            ]);

            $unitName = $request->input('unit_name'); 
            $existingUnit = Unit::where('unit_name', $unitName)->first();

            if ($existingUnit) {
                return redirect()->route('unitRead')->with('error1', 'Unit already exists!');
            }

            try {
                Unit::create([
                    'unit_name' => $request->input('unit_name'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('unitRead')->with('success', 'Unit stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('unitRead')->with('error1', 'Failed to store Unit!');
            }
        }
    }

    public function unitEdit($id) {
        $unit = Unit::all();

        $selectedUnit = Unit::findOrFail($id);

        return view('manage.unit', compact('unit', 'selectedUnit'));
    }

    public function unitUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'unit_name' => 'required',
        ]);

        try {
            $unitName = $request->input('unit_name');
            $existingUnit = Unit::where('unit_name', $unitName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUnit) {
                return redirect()->back()->with('error1', 'Unit already exists!');
            }

            $unit = Unit::findOrFail($request->input('id'));
            $unit->update([
                'unit_name' => $unitName,
            ]);

            return redirect()->route('unitEdit', ['id' => $unit->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error1', 'Failed to update Unit!');
        }
    }

    public function unitDelete($id){
        $unit = Unit::find($id);
        $unit->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}
