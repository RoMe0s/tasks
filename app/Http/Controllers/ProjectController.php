<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectShareRequest;
use App\Http\Requests\ProjectCreateRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\FlashMessages;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        'users' => 'project.users',
        'storeShare' => 'project.users',
        'loadCreate' => 'project.write'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {

        $projects = $this->projectService->load($this->user);

        $this->data('projects', $projects);

        $this->fillMeta('Список проектов');

        return $this->render('project.list');
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

        $project = Project::with(['users'])->find($id);

        abort_if(!$project, 404);

        if(!check_roles($this->user, ['Administrators'])) {

            abort_if(!$project->users->where('id', $this->user->id)->count(), 403);

        }

        if(check_roles($this->user, ['Administrators', 'Product Owner'])) {

            $roles = Role::pluck('name', 'id')->toArray();

        }

        if(check_roles($this->user, ['Client'])) {

            $roles = Role::whereIn('name', ['Product Owner'])->pluck('name', 'id')->toArray();

        }

        if(check_roles($this->user, ['R&D'])) {

            $roles = Role::whereIn('name', ['R&D'])->pluck('name', 'id')->toArray();

        }

        if(check_roles($this->user, ['Accountant'])) {

            $roles = Role::whereNotIn('name', ['Administrators', 'Product Owner'])->pluck('name', 'id')->toArray();

        }

        $this->data('roles', $roles);

        $this->data('project_id', $id);

        $this->fillMeta($project->name);

        return $this->render('project.show');
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

    public function loadCreate(Request $request) {

        $html = view('modals.project.partials.create')->with(ProjectService::loadCreateData())->render();

        return ['status' => 'success', 'html' => $html];

    }

}
