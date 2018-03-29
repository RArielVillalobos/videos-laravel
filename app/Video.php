<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    //definiendo a que tabla pertenece el modelo
    protected $table='videos';


    //relacion uno a muchos, one to many(un video puede haber varios comentarios)

    public function comments(){
        return $this->hasMany('App\Comment');

    }



    public function user(){
        return $this->belongsTo('App\User','user_id');

    }

    //has one es de uno a uno


}
