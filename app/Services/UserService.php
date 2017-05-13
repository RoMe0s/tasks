<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 08.05.17
 * Time: 23:44
 */

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;

class UserService
{

    public function update($user, $data, UploadedFile $image = null) {

       if(isset($image)) {

           $data['image'] = FileService::move($image, 'images/users', $user->id);

       }

       $data = array_filter($data);

       return $user->update($data) ? true : false;

    }

    public function create($input) {

        if(!isset($input['role'])) return false;

        $role = Role::find($input['role']);

        if(!$role) return false;

        $input['password'] = str_random(6);

        $user = new User();

        $user->fill($input);

        $user->save();

        $user->assignRole($role->name);

        return $user;

    }

}