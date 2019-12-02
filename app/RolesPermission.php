<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RolesPermission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles_permission';

    public static function checkPermissions($permission='')
    {
    	return self::where('role_key',Auth::user()->role_key)->where('permission_key',$permission)->first();
    }
}
