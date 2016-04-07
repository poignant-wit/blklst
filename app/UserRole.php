<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

}
