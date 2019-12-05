<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

    public static function permissionsViews($permission){
        if(!Utils::checkPermissions($permission)){
            self::msgAlerts(self::FALSE,'No Permission!');
            return self::FALSE;
        }

        return self::TRUE;
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

    public static function msgAlerts($data,$message = null,$ajax_request = false){
        if($data){
            $message_alert = array(
                'alert_status'    => "success",
                'alert_msg'       => (empty($message))?"Successful!":$message,
                'alert_class'     => "bg-success"
            );
        } else {
            $message_alert = array(
                'alert_status'    => "error",
                'alert_msg'       => (empty($message))?"Error occur, please try again!":$message,
                'alert_class'     => "bg-danger"
            );
        }
        Cache::add('alert_status', $message_alert['alert_status'], 2);
        Cache::add('alert_msg', $message_alert['alert_msg'], 2);
        Cache::add('alert_class', $message_alert['alert_class'], 2);

        if($ajax_request)
        {
            return response()->json($message_alert);
        }
    }
}
