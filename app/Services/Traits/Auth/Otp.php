<?php

namespace App\Services\Traits\Auth;

use App\Events\SendOTP;
use App\Helpers\Response;
use App\Services\Contracts\WebResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait Otp
{
    public function otp(Request $request, string $type = 'api'): JsonResponse|WebResponse
    {
        $request->validate([
            $this->loginBy => 'required|string|max:255',
            'otp_code' => 'required|string|max:6',
        ]);

        $user = app($this->model)->where('username', $request->get($this->loginBy))->first();

        if ($user) {
            if ((! empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                $user->otp_activated_at = Carbon::now();
                $user->otp_code = null;
                $user->is_active = true;
                $user->save();

                if ($type === 'api') {
                    return Response::success(__('your Account has been activated'));
                } else {
                    return WebResponse::make(__('your Account has been activated'))->success();
                }

            }

            if ($type === 'api') {
                return Response::errors(__('sorry this code is not valid or expired'));
            } else {
                return WebResponse::make(__('sorry this code is not valid or expired'));
            }

        }

        if ($type === 'api') {
            return Response::errors(__('user not found'), 404);
        } else {
            return WebResponse::make(__('user not found'));
        }
    }

    public function resend(Request $request, string $type = 'api'): JsonResponse|WebResponse
    {
        $request->validate([
            $this->loginBy => 'required|exists:'.app($this->model)->getTable().',username',
        ]);

        $checkIfEx = $this->model::where('username', $request->get($this->loginBy))->first();
        $checkIfEx->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $checkIfEx->save();

        SendOTP::dispatch($this->model, $checkIfEx->id);

        if ($type === 'api') {
            return Response::success(__('An OTP Has been send to your ').$this->loginType.__(' please check it'));
        } else {
            return WebResponse::make(__('An OTP Has been send to your ').$this->loginType.__(' please check it'))->success();
        }
    }
}
