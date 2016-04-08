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


    public function roles()
    {
//        return $this->belongsToMany(Role::class,'user_role');
        return $this->hasOne(UserRole::class);
    }


    public function hasRole($role)
    {
        if (is_string($role)) {
            return Role::find($this->roles->role_id)->name == $role;
//            return $this->roles->contains('name', $role);
        }
        return (bool)$role->intersect([Role::where('id', $this->roles->role_id)->firstorFail()])->count(); //TODO not string role  user hasRole
    }


    public function assign($role)
    {
        if (is_string($role)) {
            if(!$userRole = $this->role){
                $userRole = new UserRole();
                $userRole->user_id = $this->id;
            }
            $userRole->role_id = Role::where('name', $role)->firstOrFail()->id;
            return $userRole->save();
        }
        return $this->roles()->save($role);
    }


    public function commentsOwner()
    {
        return $this->hasMany(Comment::class, 'owner_id');
    }


    public function commentsTarget()
    {
        return $this->hasMany(Comment::class, 'target_id');
    }


    public static function getByPartOfName($query)
    {
                return self::where('name', 'LIKE', '%' . $query . '%')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
                    ->get();


//        $s = $sub_query->toSql();
//        $users = DB::table(DB::raw("($s) as a"))
//            ->mergeBindings($sub_query)
//            ->where('role_id', '<>', Role::where('name', 'admin')->first()->id)
//            ->get();
    }

    public static function getByEmailOrPartOfName($query){
        return self::where('email', $query)
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->orWhere('skype', $query)
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->get();
    }


}
