<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TeamEmployeeRoles;

class EmployeeRoles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_roles';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create(array $data)
    {
        return self::insert($data);
    }

    public static function updateData($id,array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function getList(array $status)
    {
        return self::whereIn('status', $status)->get();
    }

    public static function getAvailableERPerTeam(array $status,$team_id = null)
    {
        $er_by_team = TeamEmployeeRoles::where('team_id', '=', $team_id)->pluck('er_id')->toArray();
        return self::whereIn('status', $status)->whereNotIn('id',$er_by_team)->get();
    }

    public static function getEmployeeRoleByTeam(array $status,$team_id = null)
    {

        return self::whereIn('employee_roles.status', $status)->select('employee_roles.*')->leftJoin('teams_employee_roles','teams_employee_roles.er_id','=','employee_roles.id')->where('teams_employee_roles.team_id',$team_id)->get();
    }
}
