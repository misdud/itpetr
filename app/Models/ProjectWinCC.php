<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWinCC extends Model
{
    use HasFactory;

    protected $table = 'projectwinccs';

    protected $fillable = [
                'name_project',
                'name_otdelenie',
                'name_controller',
                'create_project',
                'map_project',
                'tel_project',
                'info_project',
                'id_tiaportal',
    ];

         public function projecttias(){
        return $this->belongsToMany(ProjectTIA::class, 'projectwincc_projecttia', 'projectwincc_id', 'projecttia_id' )
                                    ->withPivot('info_controller')
                                    ->withTimestamps();
    }

}
