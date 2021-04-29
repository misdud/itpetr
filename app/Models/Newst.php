<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newst extends Model
{
    protected $table = 'news';

    protected $fillable = [
                'user_id',
                'news_post',
                'news_info',
                'news_activ',

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
