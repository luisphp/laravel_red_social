<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $primaryKey = 'id_image';

    //Relación one to many - relacion uno a muchos

    protected $fillable = ['fk_id_user', 'image_path', 'description', 'created_at', 'updated_at'];

    public function comments(){
        return $this->hasMany('App\Comment', 'fk_id_image', 'id_image')->orderBy('id_comment', 'desc');
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
