<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ]);
    }
    /**
     * Admin Login
     */
    public function adminLogin(LoginRequest $request)
    {
        $user = $this->checkCredentials($request);

        if ($user->role !== 'admin') {
            throw ValidationException::withMessages([
                'email' => ['Access denied. Admins only.'],
            ]);
        }

        $token = $user->createToken('admin-token-' . now())->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * User Login
     */
    public function userLogin(LoginRequest $request)
    {
        $user = $this->checkCredentials($request);

        if ($user->role !== 'user') {
            throw ValidationException::withMessages([
                'email' => ['Access denied. Users only.'],
            ]);
        }

        $token = $user->createToken('user-token-' . now())->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->Tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Shared credential check
     */
    private function checkCredentials(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        return $user;
    }
}
