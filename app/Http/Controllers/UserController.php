<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\FlashMessages;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public $accessMap = [
        'index' => 'users.read',
        'create' => 'users.write',
        'store' => 'users.write',
        'show' => 'users.read',
        'edit' => 'users.write',
        'update' => 'users.write',
        'destroy' => 'users.destroy'
    ];

    protected $userService;

    function __construct(UserService $userService)
    {

        parent::__construct();

        $this->userService = $userService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data('roles', Role::all());

        $users = collect();

        User::has('roles')
            ->chunk(1000, function($user_list) use (&$users) {

                foreach($user_list as $user_item) {

                    $role = $user_item->roles->first()->name;

                    if(!isset($users[$role])) {

                        $users[$role] = collect();

                    }

                    $users[$role]->push($user_item);

                }

            });

        $this->data('users', $users);

        return $this->render('user.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return \Illuminate\Http\Response|array
     */
    public function store(UserCreateRequest $request)
    {

        $status = 'success';

        $message = trans('messages.save ok');

        $user = null;

        if(($user = $this->userService->create($request->all())) === FALSE) {

            $status = 'error';

            $message = trans('messages.save bad');

        }

        if($request->ajax()) {

            $html = view('user.partials.user')->with(['real_user' => $user])->render();

            return [
                'status' => $status,
                'message' => $message,
                'id' => str_slug($request->get('role')),
                'html' => $html
            ];

        }

        FlashMessages::add($status, $message);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response|array
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        if($request->ajax()) {

            $html = view('user.partials.user')->with(['real_user' => $user])->render();

            return ['status' => 'success', 'message' => trans('messages.save ok'), 'html' => $html, 'id' => $user->id];

        }

        FlashMessages::add('success', trans('messages.save ok'));

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response|array
     */
    public function destroy(User $user)
    {

        $user_id = $user->id;

        $user->delete();

        if(request()->ajax()) {

            $html = view('user.partials.empty')->render();

            return ['status' => 'success', 'message' => trans('messages.delete ok'), 'user_id' => $user_id, 'html' => $html];

        }

        FlashMessages::add('success', trans('messages.delete ok'));

        return redirect()->back();

    }

    public function loadPopup(Request $request) {

        $model = User::findOrFail($request->get('id', null));

        $html = view('modals.user.partials.' . $request->get('type', null))->with(['model' => $model])->render();

        return ['html' => $html];

    }

    public function updatePassword(UserUpdatePasswordRequest $request, User $user) {

        $user->update([
            'password' => $request->get('password')
        ]);

        if($request->ajax()) {

            return ['status' => 'success', 'message' => trans('labels.save ok')];

        }

        FlashMessages::add('success', trans('messages.save ok'));

        return redirect()->back();

    }
}
