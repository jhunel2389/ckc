<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * php artisan make:model User
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'password', 'role_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function UserInfo($user_id){
        
        return self::leftJoin('teams', 'teams.id', '=', 'users.team')->join('roles', 'roles.role_key', '=', 'users.role_key')->select('users.*','teams.team_name as team_name','teams.id as team_id','roles.description as role_description')->where('users.id',$user_id)->first();
    }

    public static function UpdateInfo($username,array $data){

        return self::where('username', $username)
            ->update($data);
    }

    public static function UserList(){
        return self::join('roles', 'roles.role_key', '=', 'users.role_key')->select('users.*','roles.description as role_description')->whereNotIn('username', ["superadmin"])
            ->get();
    }
}
