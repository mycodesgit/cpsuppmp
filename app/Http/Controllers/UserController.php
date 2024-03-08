<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Campus;
use App\Models\Office;

class UserController extends Controller
{
    //
    public function userRead() {
        $camp = Campus::all();
        $off = Office::all();

        $user = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->select('users.id as uid', 'users.*', 'campuses.*', 'office.*')
            ->get();

        return view("users.list", compact('user', 'camp', 'off'));
    }

    public function userCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'mname' => 'required',
                'username' => 'required|string|min:5|unique:users,username',
                'password' => 'required|string|min:5',
                'campus_id' => 'required',
                'office_id' => 'required',
                'gender' => 'required',
                'role' => 'required',
            ]);

            $userName = $request->input('username'); 
            $existingUser = User::where('username', $userName)->first();

            if ($existingUser) {
                return redirect()->route('userRead')->with('error1', 'User already exists!');
            }

            try {
                User::create([
                    'lname' => $request->input('lname'),
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'username' => $userName,
                    'password' => Hash::make($request->input('password')),
                    'campus_id' => $request->input('campus_id'),
                    'office_id' => $request->input('office_id'),
                    'role' => $request->input('role'),
                    'gender' => $request->input('gender'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('userRead')->with('success', 'User stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('userRead')->with('error', 'Failed to store user!');
            }
        }
    }

    public function userEdit($id) {
        $campus = Campus::all();
        $office = Office::all();
        $selectedUser = User::find($id);

        $selectedOfficeId = $selectedUser->office_id;
        $selectedCampusId = $selectedUser->campus_id;

        return view('users.edit', compact('campus', 'office', 'selectedUser', 'selectedOfficeId', 'selectedCampusId'));
    }

    public function userUpdate(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'office_id' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'campus_id' => 'required',
        ]);

        try {
            $userName = $request->input('username');
            $existingUser = User::where('username', $userName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Username already exists for another user!');
            }

            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $userName,
                'office_id' => $request->input('office_id'),
                'role' => $request->input('role'),
                'gender' => $request->input('gender'),
                'campus_id' => $request->input('campus_id'),
            ]);

            return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User!');
        }
    }

    public function userUpdatePassword(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'password' => 'required|string|min:5',
        ]);

        try {
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Password Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User Password!');
        }
    }

    public function user_settings() {
        return view("users.account_settings");
    }

    public function user_settings_profile_update(Request $request) {
        try {
            $request->validate([
                'lname' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'mname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'gender' => 'required',
            ]);

            Auth::guard('web')->user()->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $request->input('username'),
                'gender' => $request->input('gender'),
            ]);

            return redirect()->route('user_settings')->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->route('user_settings')->with('error', 'Failed to update profile');
        }
    }

    public function profilePassUpdate(Request $request) {
        try {
            $request->validate([
                'password' => 'required|string|min:5,' . Auth::id(),
            ]);

            Auth::guard('web')->user()->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('user_settings')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return redirect()->route('user_settings')->with('error', 'Failed to update Password');
        }
    }

}
