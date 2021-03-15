<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // User Register Page
    public function register_user_page()
    {
        return view('frontend.modules.register');
    }

    // User Register Store
    public function register_user(Request $request) {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email",
            "phone"  =>  "required",
            "password"  =>  "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);

        $user   =   User::create($inputs);

        if(!is_null($user)) {
            session()->flash('success', 'Success! registration completed.');
            return redirect('login.user');
        }
        else {
            session()->flash('errors', 'Registration failed!.');
            return back();
        }
    }
}
