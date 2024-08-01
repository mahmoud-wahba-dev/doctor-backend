<?php

namespace App\Http\Controllers\Api\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Auth\LoginRequest;
use App\Http\Resources\DOctor\DoctorResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(
        LoginRequest $request,
    )
    {
        $user = User::where('email',$request->email)->first();

        if(Hash::check($request->password , $user->password)){
            $token = $user->createToken($user->id)->plainTextToken;
            return DoctorResource::make($user->load('account'))->additional([
                'token'=>$token,
                'message' => __("Loged in Successfully"),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => __("wrong password Or username"),
            'status' => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST);
    }
}
