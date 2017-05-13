<?php

namespace App\Listeners;

use App\Events\Task\TaskCreateEvent;
use App\Mail\TaskCreated;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class TaskCreateListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskCreateEvent  $event
     * @return void
     */
    public function handle(TaskCreateEvent $event)
    {
        $task = $event->task;

        $role_ids = [$task->role_id];

        $PO_role = Role::where('name', 'Product Owner')->first();

        if($PO_role) {

            $role_ids[] = $PO_role->id;

        }

        $administartors = User::whereHas('roles', function ($query) {

            return $query->whereIn('name', ['Administrators']);

        })->get();

        $users = User::whereHas('projects', function($query) use ($task) {

            return $query->where('id', $task->project_id);

        })->whereHas('roles', function($query) use ($role_ids) {

           return $query->whereIn('id', $role_ids);

        })->get();

        $users = $users->merge($administartors);

        $users = $users->unique();

        foreach ($users as $user) {

            Mail::to($user->email)->queue(new TaskCreated($task));

        }

    }
}
