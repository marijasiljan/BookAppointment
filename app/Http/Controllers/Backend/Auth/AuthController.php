<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ResponseError($validator->errors(),'Invalid data!', 404);
        }
        try {
            $verificationCode = Str::random(4);

            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'surname' => $request->input('surname'),
                'verificationCode' => $verificationCode,
            ]);

            $user->save();

            event(new UserRegistered($user, $verificationCode));


            return $this->ResponseSuccess($user, '', 'User created successfully!');
        }catch (\Exception $e){
            return $this->ResponseError($e->getTrace(),'Invalid data!', 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            $token = $user->createToken('LoginToken')->plainTextToken;

            return $this->ResponseSuccess(['token' => $token], '', 'User logged in successfully!', 200);
        }
        return $this->ResponseError(null, 'Invalid Credentials', 401);
    }
}
