<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return $this->respondWithToken($request[0]['email'],$request[0]['password']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($email,$password)
    {
        $user = User::where('email', '=', $email)->first();
        if ($user) {
            if (!Hash::check($password, $user->password)) {
                $user = null;
            }
        }
        if($user)
        {
            return response()->json([
                'api_token' => $user->remember_token,
                'roles' => $user->role,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    //
    /**
     * Register new user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $validate = Validator::make($request[0], [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:4|confirmed',
        ]);
        if ($validate->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }
        $user = new User;
        $user->name = $request[0]['name'];
        $user->email = $request[0]['email'];
        $user->password = Hash::make($request[0]['password']);
        $user->role = 'user';
        $user->remember_token= Str::random(10);
        $user->save();
        response()->json([
            'api_token' => $user->remember_token,
            'roles' => $user->role,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
