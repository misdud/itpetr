<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name',
        //'email',
        //'password',
        'id_position',
        'id_depart',
        'id_subdepart',
        'fio_full',
        'login',
        'password',
        'tel_belki',
        'tel_mob',
        'room',
        'dr',
        'prioritet',
        'activ',
        'itr',
        'show_manager',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       // 'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class,  'depart_id', 'id');
    }

    public function subdepartment(){
        return $this->belongsTo(Subdepartmen::class, 'subdepart_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class,  'position_id', 'id');
    }


    public function roles(){
        return $this->belongsToMany(Role::class, 'roles_users',  'user_id', 'role_id')->withTimestamps();
    }

}
