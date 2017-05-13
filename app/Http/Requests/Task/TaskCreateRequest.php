<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('project', null);

        return [
            'name' => 'required|max:60|min:3|string|unique:tasks,name,' . $id . ',project_id',
            'description' => 'required|max:195|string',
            'type' => 'required',
            'post' => 'required',
            'price' => ['required', 'regex:' . "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/"],
            'role_id' => 'required|integer',
            'project_id' => 'required|integer',
            'file' => 'required',
            'file-name' => 'required|string'
        ];
    }
}
