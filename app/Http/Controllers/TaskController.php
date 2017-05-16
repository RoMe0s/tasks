<?php

namespace App\Http\Controllers;

use App\Events\Task\TaskCreateEvent;
use App\Http\Requests\Task\TaskCloseRequest;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\FlashMessages;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Event;

class TaskController extends Controller
{

    public $accessMap = [
        'store' => 'task.write',
        'destroy' => 'task.destroy',
        'loadDelete' => 'task.destroy',
        'take'      => 'task.take',
        'end'   => 'task.close',
        'close' => 'task.close'
    ];


    protected $taskService;

    function __construct(TaskService $taskService)
    {
        parent::__construct();

        $this->taskService = $taskService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskCreateRequest $request
     * @return \Illuminate\Http\Response|array
     */
    public function store(TaskCreateRequest $request)
    {

        $status = 'success';

        $message = trans('messages.save ok');

        try {

            $task = $this->taskService->store($request);

            if($request->has('newsletter')) {

                Event::fire(new TaskCreateEvent($task));

            }

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans('messages.save bad');

        }

        if ($request->ajax()) {

            if ($status === 'success') {

                FlashMessages::add($status, $message);

            }

            return ['status' => $status, 'message' => $status === 'success' ? null : $message, 'refresh' => $status === 'success' ? 'true' : null];

        }

        FlashMessages::add($status, $message);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response|array
     */
    public function destroy($id)
    {

        $status = 'success';

        $message = trans('messages.delete ok');

        try {

            $this->taskService->delete($id);

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans('messages.delete bad');

        }

        if (request()->ajax()) {

            return ['status' => $status, 'message' => $message, 'task_id' => $id];

        }

        FlashMessages::add($status, $message);

        return redirect()->back();

    }

    public function loadDelete(Request $request)
    {

        $id = $request->get('id', null);

        $task = Task::findOrFail($id);

        $html = view('modals.task.partials.delete')->with(['model' => $task])->render();

        return ['html' => $html];

    }

    public function take(int $id, Request $request)
    {

        $status = 'success';

        $message = trans('messages.save ok');

        try {

            $task = Task::findOrFail($id);

            if (isset($task->user_id)) {

                throw new \Exception(trans('messages.this task already have user'));

            }

            $this->taskService->attachToUser($task, $this->user);

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans($e->getMessage());

        }

        if ($request->ajax()) {

            if ($status === 'success') {

                FlashMessages::add($status, $message);

            }

            return ['status' => $status, 'message' => $status === 'success' ? null : $message, 'refresh' => $status === 'success' ? 'true' : null];

        }

        FlashMessages::add($status, $message);

        return redirect()->back();

    }

    public function end(int $id, Request $request)
    {

        $status = 'success';

        $message = null;

        $html = null;

        try {

            $task = Task::findOrFail($id);

            if (!$task->user_id || $task->user_id != $this->user->id) {

                throw new \Exception(trans('messages.permission not allowed'));

            }

            $html = view('modals.task.partials.result')->with(['task' => $task])->render();

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans('messages.error');

        }

        if ($request->ajax()) {

            return ['status' => $status, 'message' => $message, 'html' => $html];

        }

        if ($message) {

            FlashMessages::add($status, $message);

        }

        return redirect()->back();

    }

    public function close(int $id, TaskCloseRequest $request) {

        $status = 'success';

        $message = trans('messages.save ok');

        try {

            $task = Task::findOrFail($id);

            if (!check_roles($this->user, ['Administrator']) && (!$task->user_id || $task->user_id != $this->user->id)) {

                throw new \Exception(trans('messages.permission not allowed'));

            }

            $this->taskService->close($task, $request);

        } catch (\Exception $e) {

            $status = 'error';

            $message = trans('messages.save bad');

        }

        if($request->ajax()) {

            if($status === 'success') {

                FlashMessages::add($status, $message);

                return ['status' => $status, 'message' => $status === 'success' ? null : $message, 'refresh' => $status === 'success' ? 'true' : null];

            }

        }

        FlashMessages::add($status, $message);

        return redirect()->back();

    }

}
