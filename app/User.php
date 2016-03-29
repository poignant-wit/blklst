<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'user_role');
    }

    public function hasRole($role){
        if (is_string($role)){
            return $this->roles->contains('name', $role);
        }
        return (bool) $role->intersect($this->roles)->count();
    }

    public function assign($role){
        if (is_string($role)){
            return $this->roles()->save(Role::where('name',$role)->firstOrFail());
        }
        return $this->roles()->save($role);
    }

    public function commentsOwner(){
        return $this->hasMany(Comment::class, 'owner_id');
    }

    public function commentsTarget(){
        return $this->hasMany(Comment::class, 'target_id');
    }
}
