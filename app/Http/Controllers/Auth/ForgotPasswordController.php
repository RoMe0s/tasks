<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetRequest;
use App\Models\User;
use App\Services\FlashMessages;

class ForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(ResetRequest $request) {

        $email = $request->get('email');

        $user = User::where('email', $email)->first();

        $type = 'success';

        $message = trans('messages.password reset successful');

        if($user) {

            $user->setForgotten();

        } else {

            $type = 'error';

            $message = trans('messages.password reset error');

        }

        if(!$request->ajax()) {

            FlashMessages::add($type, $message);

            return $this->render('auth.login');

        }

        return ['status' => $type, 'message' => $message];

    }
}
