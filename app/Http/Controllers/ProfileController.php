<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\FlashMessages;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $userService = null;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {

        $model = Auth::user();

        $this->data('model', $model);

        return $this->render('profile.index');

    }

    public function update(ProfileUpdateRequest $request) {

        $message = trans('messages.save ok');

        $status = 'success';

        if(!$this->userService->update(Auth::user(), $request->except('image'), $request->file('image.file', null))) {

            $status = 'error';

            $message = trans('messages.save error');

        }

        FlashMessages::add($status, $message);

        if(!$request->ajax()) {

            return redirect()->back()->withInput($request->all());

        }

        return ['status' => $status, 'refresh' => 'refresh'];
    }
}
