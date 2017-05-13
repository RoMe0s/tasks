<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'forgot_password'
    ];

    public function setPasswordAttribute($value) {

        $this->attributes['password'] = bcrypt($value);

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['roles', 'roles.permissions'];

    public function setForgotten($value = true) {

        $this->forgot_password = true;

        $this->save();

    }

    public function projects() {

        return $this->belongsToMany(Project::class, 'users_projects');

    }

    public function getImage() {

        if(isset($this->image) &&
        !empty($this->image) &&
        is_file(public_path() . $this->image)) {

            return $this->image;

        }

        return asset('images/sample/user.png');

    }

    public function tasks() {

        return $this->hasMany(Task::class);

    }

}
