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

        return url('img/logo/sample_pic.jpg');

    }

}
