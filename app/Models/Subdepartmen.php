<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdepartmen extends Model
{
    use HasFactory;

    protected $table = 'subdepartmens';

    protected $fillable = ['name_subdepart','priori_sub'];

    public function department(){
        return $this->belongsTo(Department::class, 'depart_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'subdepart_id', 'id');
    }



}
