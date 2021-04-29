<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Svod extends Model
{
    use HasFactory;

    protected $table = 'svods';

    protected $fillable = [
        'user_id',
        'post',
        'info',
        ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
