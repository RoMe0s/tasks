<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 11.05.17
 * Time: 22:58
 */

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use DB;

class ProjectService {

    public function load(User $user) {

        //TODO

        $projects = Project::with(['users'])->orderBy('created_at', 'DESC');

        if(!$user->hasRole('Administrators')) {

            $projects = $projects->whereHas('users', function($query) use ($user) {

                return $query->where('users.id', $user->id);

            });

        }

        return $projects->get();

    }

    public static function loadCreateData() {

        $users = User::whereHas('roles', function($query) {

            return $query->whereNotIn('name', ['Administrators']);

        })->get();

        return ['users' => $users, 'model' => new Project];

    }

    public function store($request, Project $project) {

        DB::beginTransaction();

        try {

            $project->fill($request->only(['name', 'description']));

            if ($request->hasFile('image')) {

                $project->image = ImageService::move($request->file('image'), 'images/folder');

            }

            $project->save();

            $project->users()->attach($request->get('users', []));

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            throw new \Exception($e->getMessage());

        }

    }

}
