<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departmens';

    protected $fillable = ['name_depart','priori'];

    public function subdepartmens(){
        return $this->hasMany('Subdepartmen::class', 'depart_id', 'id');
    }

    public function users(){
        return $this->hasMany('User::class', 'depart_id', 'id');
    }

}
