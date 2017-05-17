<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\FlashMessages;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService = null;

    function __construct(UserService $userService)
    {

        parent::__construct();

        $this->userService = $userService;

        $this->fillMeta('Настройки');

    }

    public function index() {

        $model = $this->user;

        $this->data('model', $model);

        return $this->render('profile.index');

    }

    public function update(ProfileUpdateRequest $request) {

        $message = trans('messages.save ok');

        $status = 'success';

        if(!$this->userService->update($this->user, $request->except('image'), $request->file('image.file', null))) {

            $status = 'error';

            $message = trans('messages.save bad');

        }

        FlashMessages::add($status, $message);

        if(!$request->ajax()) {

            return redirect()->back()->withInput($request->all());

        }

        return ['status' => $status, 'refresh' => 'refresh'];
    }
}
