<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * TaskCreated constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject(trans('texts.new task in project') . ' ' . $this->task->project->name);

        return $this->view('emails.new_task');
    }
}
