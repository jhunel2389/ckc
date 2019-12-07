<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamEmployeeRoles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams_employee_roles';

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

    public static function getListByTeam($data)
    {
        return self::leftJoin('employee_roles', 'employee_roles.id', '=', 'teams_employee_roles.er_id')->select('teams_employee_roles.id as id','employee_roles.name as name')->where('teams_employee_roles.team_id', $data['team_id'])->get();
    }
}
