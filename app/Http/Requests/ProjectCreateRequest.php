<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
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

        $users = json_decode($this->request->get('users', "[]"));

        $this->merge(['users' => $users]);

        return [
            'name' => 'required|max:60|min:3|string|unique:projects',
            'description' => 'required|max:195|string'
        ];
    }
}
