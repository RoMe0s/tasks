<?php

namespace App\Http\Controllers\Auth;

use App\Events\User\PasswordResetEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetRequest;
use App\Models\User;
use App\Services\FlashMessages;
use Illuminate\Support\Facades\Event;

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

            Event::fire(new PasswordResetEvent($user));

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
