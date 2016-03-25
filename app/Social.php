<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'users_social';


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
