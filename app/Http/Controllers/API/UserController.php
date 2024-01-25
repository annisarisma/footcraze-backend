<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        try {
            // Request Validate
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', Password::min(8)]
            ]);

            // User Create
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Token Generate
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // Return JSON
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (Exception $error) {
            // Return JSON
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    /**
     * Login the form for creating a new resource.
     */
    public function login(Request $request)
    {
        // Try Catch
        try {
            // Request Validate
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            // Check Remember
            $remember = $request->has('remember') ? true : false;

            // Credential Auth
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                // Token Generate
                $user = User::findOrFail(auth()->id());
                $tokenResult = $user->createToken('authToken')->plainTextToken;

                // Return JSON
                return ResponseFormatter::success([
                    'access_token' => $tokenResult,
                    'token_type' =>'Bearer',
                    'user' => $user
                ], 'User Login Successfully');
            }

            // Credential Failed
            return ResponseFormatter::error([
                'message' => 'Unauthorized'
            ], 'Authentication Failed', 500);

        } catch (Exception $error) {
            // Return JSON
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authenticate Failed', 500);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
