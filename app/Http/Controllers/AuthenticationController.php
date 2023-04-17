<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $role = $user->role;
            
            $success['name'] =  $user->name;
            $success['email'] = $user->email;
            $success['password'] = $user->password;

            if ($role = ('admin')) {
                
                $success['token'] =  $user->createToken('MyApp', ['admin'])->plainTextToken;

            } else {
                
                 $success['token'] =  $user->createToken('MyApp', ['user'])->plainTextToken;
            }
            
            return response()->json([
                'status' => 200,
                'data' => $success
            ]);

        }
        else{
            return response()->json(['error'=>'Login Unsuccesfully']);
        }
    }
    public function signup(Request $request)
    {
        $validator = Validator ::make($request->all(), [
            'name' => ' required',
            'gender' => 'required',
            'email' => 'required|email',
            'telp_number' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Error validation', $validator->errors()], 200);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $success['token'] = $user->createToken('auth_token')->plainTextToken();
        $success['name'] = $user->name;

        return response()->json(['data' => $user], 201);


    }
 }
