<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|string|unique:admins,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $admin = Admin::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $admin->createToken('tokenku')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = Admin::where('email', $fields['email'])->first();

        if (!$admin || !Hash::check($fields['password'], $admin->password))
        return response([
            'message' => 'unauthorized'
        ], 401);

        $token = $admin->createToken('tokenku')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token
        ];

        return response ($response, 201);
    }

    public function logout(Request $request)
    {
        $request->admin()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}