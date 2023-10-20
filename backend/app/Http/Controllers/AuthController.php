<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(!Auth::attempt($credentials)){
           return response([
               'error'=>'not_authorized',
               'result'=>'not_authorized'
           ],401);
        }
        $user = User::where('username',$credentials['username'])->first();
        $authToken = $user->createToken('auth_token');
        $token = $authToken->plainTextToken;
        return ResponseService::generateResponse([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'birthdate'=>'date',
            'username'=>'required|unique:users,username',
            'password'=>'required|confirmed'
        ]);
        $user = User::create(
            [
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'birthdate'=>$data['birtdate']??null,
                'username'=>$data['username'],
                'password'=>Hash::make($data['password'])
            ]
        );
        $user->givePermissionTo('can_create_events');

        return ResponseService::generateResponse('success',null);

    }
}
