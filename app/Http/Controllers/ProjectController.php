<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectShareRequest;
use App\Http\Requests\ProjectCreateRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\FlashMessages;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    protected $projectService;

    function __construct(ProjectService $projectService)
    {

        parent::__construct();

        $this->projectService = $projectService;

    }

    public $accessMap = [
        'index' => 'project.read',
        'create' => 'project.write',
        'store' => 'project.write',
        'show' => 'project.read',
        'edit' => 'project.write',
        'update' => 'project.write',
        'destroy' => 'project.destroy'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {

        $projects = $this->projectService->load(Auth::getUser());

        $this->data('projects', $projects);

        return $this->render('project.list');
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
     * @param ProjectCreateRequest $request
     * @param Project $project
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function store(ProjectCreateRequest $request, Project $project)
    {

        $message = trans('messages.save ok');

        $status = 'success';

        try {

            $this->projectService->store($request, $project);

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans('messages.save bad');

        }

        if($request->ajax()) {

            if($status === 'error') {

                return ['status' => $status, 'message' => $message];

            }

            FlashMessages::add($status, $message);

            return ['status' => $status, 'refresh' => 'true'];

        }

        FlashMessages::add($status, $message);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function share(int $id) {

        $project = Project::with(['users'])->find($id);

        $users = ProjectService::loadCreateData()['users'];

        $isset_users = $project->users->pluck('id')->toArray();

        $html = view('modals.project.partials.share')->with(['users' => $users, 'isset_users' => $isset_users, 'model' => $project])->render();

        return ['status' => 'success', 'html' => $html];

    }

    public function storeShare(int $id, ProjectShareRequest $request) {

        $message = trans('messages.save ok');

        $status = 'success';

        try {

            $project = Project::findOrFail($id);

            $project->users()->detach();

            $project->users()->attach($request->get('users', []));

        } catch (\Exception $e) {

            $message = trans('messages.save bad');

            $status = 'error';

        }

        if($status === 'success') {

            FlashMessages::add($status, $message);

        }

        return ['status' => $status, 'message' => $status === 'error' ? $message : null, 'refresh' => $status === 'success' ? 'true' : null];

    }

}
