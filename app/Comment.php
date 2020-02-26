<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'id_comment';

    //Relacion de muchos a uno -  Many to one
    public function user(){
        return $this->belongsTo('App\User', 'fk_id_user', 'id_user');
    }

    //Relacion de muchos a uno -  Many to one
    public function image(){
        return $this->belongsTo('App\Image', 'fk_id_image', 'id_image');
    }

}
