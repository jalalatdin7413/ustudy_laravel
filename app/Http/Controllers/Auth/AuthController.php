<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->FirstOrFail();

            if (!Hash::check($request->password, $user->password)) {
            }

            auth()->login($user);
            

            return response()->json([
                    'token' => $user->createToken('core api')->plainTextToken
            ]);
            
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("paydalaniwshi tabilmadi");
        }
    }
}
