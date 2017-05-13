<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 08.05.17
 * Time: 22:35
 */

namespace App\Http\ViewComposers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\ProjectService;
use Spatie\Permission\Models\Role;

class TaskComposer
{

    private function _chunkCallback($r_tasks)
    {

        $tasks = collect();

        foreach ($r_tasks as $r_task) {

            $status = $r_task->status;

            if (!isset($tasks[$status])) {

                $tasks[$status] = collect();

            }

            $tasks[$status]->push($r_task);
        }

        return $tasks;

    }

    public function compose(View $view)
    {

        $project_id = request()->route('project');

        $tasks = collect();

        $user = Auth::user();

        $task_query = Task::with(['user'])->where('project_id', $project_id)
            ->select(
                'tasks.*',
                \DB::raw("
                    CASE
                        WHEN type = 'urgent' THEN 3
                        WHEN type = 'current' THEN 2
                        WHEN type = 'not urgent' THEN 1 
                    END AS sort_type
                "),
                \DB::raw("
                    CASE
                        WHEN end_date <> '' THEN end_date
                        WHEN start_date <> '' THEN start_date
                        ELSE created_at
                    END as sort_date
                ")
            )
            ->orderBy('sort_type', 'DESC')
            ->orderBy('sort_date', 'DESC');

        if(!check_roles($user, ['Administrators', 'Product Owner'])) {

            if(check_roles($user, ['R&D', 'Accountant'])) {

                $task_query->whereIn('role_id', $user->roles->pluck('id')->toArray());

            }

            if(check_roles($user, ['Client'])) {

                $rd = Role::findByName('R&D');

                $task_query->whereNotIn('role_id', [$rd->id]);

            }

        }

        $task_query->chunk(100, function ($r_tasks) use (&$tasks) {

            $tasks = $tasks->merge($this->_chunkCallback($r_tasks));

        });

        $view->with('tasks', $tasks);

    }

}
