<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //register

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'gender' => 'required',
            'address' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Registered Successfully',
            'user' => $user
        ]);
    }

    // login

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials'
            ]);
        }

        // TOKEN CREATE
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login Successfully',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {

        $user = auth()->user();

        if (!$user) {

            return response()->json([

                'status' => false,

                'message' => 'User not found'
            ]);
        }

        // VALIDATION
        $validator = Validator::make($request->all(), [

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'required',

            'gender' => 'required',

            'address' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()
            ]);
        }

        // UPDATE PROFILE
        $user->name = $request->name;

        $user->email = $request->email;

        $user->phone = $request->phone;

        $user->gender = $request->gender;

        $user->address = $request->address;

        // OPTIONAL PASSWORD
        if ($request->password) {

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json([

            'status' => true,

            'message' => 'Profile Updated',

            'user' => $user
        ]);
    }
}
