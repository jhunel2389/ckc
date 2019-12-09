<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Roles;
use App\Permission;
use DB;
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

    public static function getPermissionPerRole($role_key){
        $data = Permission::select('description as name','permission_key as permission_key')->get();
        $roles_permission = self::where('role_key', '=', $role_key)->pluck('permission_key')->toArray();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                if(in_array($value->permission_key, $roles_permission)){
                    $data[$key]['enabled'] = true;
                }else{
                    $data[$key]['enabled'] = false;
                }
            }
        }
        return $data;
    }   
}
