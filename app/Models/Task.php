<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'post',
        'price',
        'file',
        'role_id',
        'project_id',
        'user_id',
        'start_date',
        'end_date',
        'result'
    ];

    public function role() {

        return $this->belongsTo(Role::class);

    }

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function getPrice() {

        return $this->price;

    }

    public function getFileName() {

        $name = explode("/", $this->file);

        return array_pop($name);

    }

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date'
    ];

    public function getResult() {

        if(is_file(public_path() . $this->result)) {

            return 'download = "download" href="' . $this->result . '"';

        }

        return 'href="' . $this->result . '"';

    }

    public function getStartDateAttribute($value) {

        if($value) {

            return Carbon::parse($value)->format('d-m-Y H:i');

        }

        return '';

    }

    public function getEndDateAttribute($value) {

        if($value) {

            return Carbon::parse($value)->format('d-m-Y H:i');

        }

        return '';

    }

    public function project() {

        return $this->belongsTo(Project::class);

    }

}
