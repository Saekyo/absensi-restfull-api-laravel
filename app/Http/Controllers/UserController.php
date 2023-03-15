<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $tableUser = new User;
        $tableUser->username = $request->username;
        $tableUser->email = $request->email;
        $tableUser->password = $request->password;

    $tableUser->save();

    return response()->json([
        'status' => 'success',
        'data' => $tableUser
        ]);
    }

    public function index()
    {
    $user = User::all();

    return response()->json([
        'status' => 'success',
        'data' => $user
    ], 200);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'message' => 'successsfully delete user',
        ]);
    }

    public function update(Request $request,$id)
    {
        //
        $user = User::find($id);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'telp_number' => $request->telp_number
        ]);

        return response()->json([
            'message' => 'successsfully update user data',
            'data' => [
                $user
            ]
        ]);
    }

    public function getPerUser($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    // public function spandex()
    // {
    //     $user = User::;
    //    return dd($user);
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $user
    //     ]);
    // }
}
