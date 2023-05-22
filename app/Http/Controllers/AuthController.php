<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){


        
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
       
 
        return response()
        ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'bearer']);
        
}

public function login(Request $request){

    if(!Auth::attempt($request->only('email', 'password'))){

        return response()->json([

            'message' => 'unauthorized'

        ]);


}

$user = User::where('email', $request->email)->firstOrFail();
$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([

    'data' => $user,
    'access_token' => $token,
    'token_type' => 'bearer'


]);

}

public function logout(Request $request){
    

    auth()->user()->tokens()->delete();

          return [
              'message' => 'Logged out'
          ];

}

}