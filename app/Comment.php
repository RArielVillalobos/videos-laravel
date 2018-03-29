<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table='comments';

    //Relacion muchos a uno, un usuario puede comentar muchas veces
    public function user(){
        return $this->belongsTo('\App\User','user_id');

    }

    public function video(){
        return $this->belongsTo('\App\Video','video_id');
    }

}
