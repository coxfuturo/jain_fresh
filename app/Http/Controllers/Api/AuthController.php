<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function profile(Request $request)
    {

        $user = auth()->user();

        if (!$user) {

            return response()->json([

                'status' => false,

                'message' => 'User not found'
            ]);
        }

        return response()->json([

            'status' => true,

            'message' => 'User Profile',

            'user' => [

                'id' => $user->id,

                'name' => $user->name,

                'email' => $user->email,

                'phone' => $user->phone,

                'gender' => $user->gender,

                'address' => $user->address,

                'image' => $user->image
                    ? asset('storage/' . $user->image)
                    : null
            ]
        ]);
    }
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

            'name' => 'nullable|string',

            'email' => 'nullable|email|unique:users,email,' . $user->id,

            'phone' => 'nullable',

            'gender' => 'nullable',

            'address' => 'nullable',

            'password' => 'nullable|min:6',

            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()
            ]);
        }

        // UPDATE ONLY IF VALUE EXISTS

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // EMAIL UPDATE
        if ($request->filled('email')) {

            $user->email = $request->email;
        }

        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->filled('gender')) {
            $user->gender = $request->gender;
        }

        if ($request->filled('address')) {
            $user->address = $request->address;
        }

        // PASSWORD UPDATE
        if ($request->filled('password')) {

            $user->password = bcrypt($request->password);
        }

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            // OLD IMAGE DELETE
            if ($user->image && Storage::disk('public')->exists($user->image)) {

                Storage::disk('public')->delete($user->image);
            }

            // SAVE IMAGE
            $imagePath = $request->file('image')
                ->store('users', 'public');

            $user->image = $imagePath;
        }

        $user->save();

        return response()->json([

            'status' => true,

            'message' => 'Profile Updated Successfully',

            'user' => $user
        ]);
    }

    public function updateProfileImage(Request $request)
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

            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'errors' => $validator->errors()
            ]);
        }

        // DELETE OLD IMAGE
        if ($user->image && Storage::disk('public')->exists($user->image)) {

            Storage::disk('public')->delete($user->image);
        }

        // UPLOAD NEW IMAGE
        $imagePath = $request->file('image')
            ->store('users', 'public');

        // SAVE IMAGE
        $user->image = $imagePath;

        $user->save();

        return response()->json([

            'status' => true,

            'message' => 'Profile Image Updated',

            'image_url' => asset('storage/' . $imagePath),

            'user' => $user
        ]);
    }

    public function deleteProfileImage()
    {

        $user = auth()->user();

        if (!$user) {

            return response()->json([

                'status' => false,

                'message' => 'User not found'
            ]);
        }

        // DELETE IMAGE
        if ($user->image && Storage::disk('public')->exists($user->image)) {

            Storage::disk('public')->delete($user->image);
        }

        // REMOVE FROM DB
        $user->image = null;

        $user->save();

        return response()->json([

            'status' => true,

            'message' => 'Profile Image Deleted'
        ]);
    }
}
