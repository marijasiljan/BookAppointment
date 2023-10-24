<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends BaseController
{
    public function verifyCode(Request $request)
    {
        $user = Auth::user();
        $verificationCode = $request->input('verificationCode');

        if ($user->verificationCode === $verificationCode) {
            return $this->ResponseSuccess($user, '', 'User verified successfully!');
        } else {
            return $this->ResponseError(0,'Invalid data!', 500);
        }
    }


}
