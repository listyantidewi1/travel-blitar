<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthenticationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            // "username" => " butuh username"
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        if (Auth::attempt($request->all())) {
            $token = md5($request->username);
            User::where("username", $request->username)->update([
                'remember_token' => $token,
            ]);

            return response()->json([
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'invalid login',
        ], 401);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        if (User::where("remember_token", $request->token)->exists()) {
            User::where("remember_token", $request->token)->update([
                'remember_token' => ''
            ]);

            return response()->json([
                'message' => 'logout success',
            ], 200);
        }
        return response()->json([
            'message' => 'Unauthorized user',
        ], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
