<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::updateOrCreate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($user)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Registered successfully.'
            ]);
        }else{
            return response()->json([
                'status' => 403,
                'message' => 'Registered faild.'
            ]);
        }
    }


    public function login(Request $request)
    {
        // dd($request);
        $email = $request->email;
        $password = $request->password;

        $user = User::where(['email' => $email])->first();

        if(!Hash::check($password, $user->password)){
            echo "Not matched";
        }else{
            echo $user->first_name .' '. $user->last_name;
        }
    }
}
