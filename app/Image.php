<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $primaryKey = 'id_image';

    //Relación one to many - relacion uno a muchos

    public function comments(){
        return $this->hasMany('App\Comment', 'fk_id_image', 'id_image');
    }

    //Relación one to many - relacion uno a muchos
    public function likes(){
        return $this->hasMany('App\Like', 'fk_id_image', 'id_image');
    }

    //Relación de muchos a uno -  Many to one
    public function user(){
        return $this->belongsTo('App\User', 'fk_id_user', 'id_user');
    }


}
