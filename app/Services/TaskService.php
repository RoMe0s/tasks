<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 13.05.17
 * Time: 0:16
 */

namespace App\Services;


use App\Models\Task;
use Carbon\Carbon;
use DB;

class TaskService
{
    
    private function _prepareData($data) {
        
        $data['type'] = array_flip($data['type']);

        $data['type'] = array_pop($data['type']);

        $data['status'] = "todo";

        return $data;
        
    }

    public function store($request) {

        DB::beginTransaction();

        try {

            $data = $this->_prepareData($request->except(['file']));

            $task = new Task();

            $task->fill($data);

            $task->save();

            if ($request->hasFile('file')) {

                $task->file = FileService::move($request->file('file'), 'tasks/questions/' . $task->id . $task->id);

                $task->save();

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            throw  new \Exception($e->getMessage());

        }

        return $task;

    }

    public function attachToUser($task, $user) {

        try {

            $task->update([
                'user_id' => $user->id,
                'start_date' => Carbon::now()->toDateTimeString(),
                'status' => 'in_progress'
            ]);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }

    }

    public function close($task, $request) {

        try {

            $task->update([
                'end_date' => Carbon::now()->toDateTimeString(),
                'status' => 'done'
            ]);

            $task->end_date = Carbon::now()->toDateTimeString();
            $task->status = 'done';

            if ($request->hasFile('file')) {

                $task->result = FileService::move($request->file('file'), 'tasks/results/' . $task->id);

            } elseif ($request->has('link')) {

                $task->result = $request->get('link');

            }

            $task->save();

        } catch (\Exception $e) {

            throw  new \Exception($e->getMessage());

        }

        return $task;

    }

}