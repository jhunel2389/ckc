<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RolesPermission;
class Utils extends Controller
{

    public static function checkPermissions($permission){
    	$user_role = Auth::user()->role_key;
    	if($user_role == self::SUPERADMIND){
    		return self::TRUE;
    	} else {
    		$isHave = RolesPermission::checkPermissions($permission);
    	}
    	
        return !empty($isHave);
    }

    public static function statusIntToString($statusInt){
        switch ($statusInt) {
            case self::STATUS_ACTIVE:
                return "Active";
                break;
            case self::STATUS_DISABLED:
                return "Disabled";
                break;
            case self::STATUS_DELETED:
                return "Deleted";
                break;
            default:
                return $statusInt;
                break;
        }
    }
}
