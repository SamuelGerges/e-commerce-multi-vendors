<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;


class VerificationServices
{
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        VerificationCode::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return VerificationCode::create($data);
    }

    public function getSMSVerifyMessageByAppName($code)
    {
        $message = " is your verification code for your account ";
        return $code . $message;
    }

    public function CheckOTPCode($code)
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $verificationData = VerificationCode::where('user_id', auth()->id())->first();
            if ($verificationData->code == $code) {
                User::whereId(auth()->id())->update(['verified_at' => now()]);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function removeOTPCode($code)
    {
        VerificationCode::where('code', $code)->delete();
    }

}
