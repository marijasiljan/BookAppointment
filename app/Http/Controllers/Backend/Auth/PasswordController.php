<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Events\PasswordResetEvent;
use App\Http\Controllers\BaseController;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordController extends BaseController
{
    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->ResponseError('User not found.', 404);
        }
        try {
            $verificationCode = Str::random(4);

            $user->verificationCode = $verificationCode;
            $user->save();


           event(new PasswordResetEvent($user, $verificationCode));


            return $this->ResponseSuccess($user, '', 'Password Reset Email sent successfully!');
        }
        catch (\Exception $e){
            return $this->ResponseError($e->getTrace(),'Invalid data!', 500);
        }
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'verificationCode' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))
            ->where('verificationCode', $request->input('verificationCode'))
            ->first();

        if(!$user) {
            return $this->ResponseError('User not found.', 404);
        }
        try{
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return $this->ResponseSuccess($user, '', 'Password changed successfully!');
        }
        catch (\Exception $e){
            return $this->ResponseError($e->getTrace(),'Invalid data!', 500);
        }
    }


}
