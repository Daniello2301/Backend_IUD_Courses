<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    const STUDENT_ROLE = 3;


    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //Check Email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password))
        {
            return response()->json([
                'code' => 401,
                'status' => 'failed',
                'message' => 'Bad credentials'
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'code' => 200,
            'message' => 'login successful',
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function register(Request $request){

        $role = 0;
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        if($request->role_id)
        {
            $role = $request->role_id;
        }else{
            $role = self::STUDENT_ROLE;
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'role_id'=> $role,
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'code' => 200,
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'code' => 200,
            'message' => 'Logged out'
        ];
    }
}
