<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Email / password tidak cocok!'
            ]);
        }

        try {
            $user = User::where('email', $request->email)->firstOrFail();
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Email / password tidak cocok!'
            ]);
        }

        $token = $user->createToken('belajar-laravel')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Berhasil login!',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'data' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('belajar-laravel')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Berhasil registrasi!',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout!'
        ]);
    }
}
