<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function users() {

        return $this->belongsToMany(User::class, 'users_projects');

    }

    public function getImage() {

        return isset($this->image) && !empty($this->image) && is_file(public_path() . $this->image) ? $this->image : $this->getDefaultImage();

    }

    public function getDefaultImage() {

        return url('images/logo/sample_pic.jpg');

    }

    public function getPrice() {

        return isset($this->tasks) && sizeof($this->tasks) ? $this->tasks->sum('price') : 0;

    }

    public function tasks() {

        return $this->hasMany(Task::class);

    }

    public function getUrl() {

        return route('project.show', $this->id);

    }

}
