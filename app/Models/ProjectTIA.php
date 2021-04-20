<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTIA extends Model
{
    protected $table = 'projecttias';

    protected $fillable = [
                'organization',
                'name',
                'fio_dev',
                'tel_dev',
                'ip',
                'room_set',
                'info',

    ];

     public function projectwinccs(){
        return $this->belongsToMany(ProjectWinCC::class, 'projectwincc_projecttia', 'projecttia_id','projectwincc_id');
    }
}
