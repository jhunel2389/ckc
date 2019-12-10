<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\EmployeeRoles;

class AjaxController extends Controller
{
    public function getActiveTeams(){
        return Teams::getTeamList([self::STATUS_ACTIVE]);
    }

    public function getEmployeeRoleByTeam(Request $request){
        $list = EmployeeRoles::getEmployeeRoleByTeam([self::STATUS_ACTIVE],$request['team_id']);
        return $list;
    }
}
