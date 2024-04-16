<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;

class CategoryController extends Controller
{   
    public function categoryRead() {
        $category = Category::orderBy('category_name', 'ASC')->get();
        return view('manage.category', compact('category'));
    }

    public function categoryCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_name' => 'required',
            ]);

            $categoryName = $request->input('category_name'); 
            $existingCategory = Category::where('category_name', $categoryName)->first();

            if ($existingCategory) {
                return redirect()->route('categoryRead')->with('error1', 'Category already exists!');
            }

            try {
                Category::create([
                    'category_name' => $request->input('category_name'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('categoryRead')->with('success', 'Category stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('categoryRead')->with('error1', 'Failed to store Category!');
            }
        }
    }

    public function categoryEdit($id) {
        $category = Category::all();

        $selectedCategory = Category::findOrFail($id);

        return view('manage.category', compact('category', 'selectedCategory'));
    }

    public function categoryUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_name' => 'required',
        ]);

        try {
            $categoryName = $request->input('category_name');
            $existingCategory = Category::where('category_name', $categoryName)->where('id', '!=', $request->input('id'))->first();

            if ($existingCategory) {
                return redirect()->back()->with('error1', 'Category already exists!');
            }

            $category = Category::findOrFail($request->input('id'));
            $category->update([
                'category_name' => $categoryName,
            ]);

            return redirect()->route('categoryEdit', ['id' => $category->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error1', 'Failed to update Category!');
        }
    }

    public function categoryDelete($id){
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}
