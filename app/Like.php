<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $primaryKey = 'id_like';

    //Relacion de muchos a uno -  Many to one
    public function user(){
        return $this->belongsTo('App\User', 'fk_id_user', 'id_user');
    }

    //Relacion de muchos a uno -  Many to one
    public function image(){
        return $this->belongsTo('App\Image','fk_id_image', 'id_image');
    }
}
