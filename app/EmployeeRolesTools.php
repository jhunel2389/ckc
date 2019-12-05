<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRolesTools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_roles_tools';

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

    public static function getListByER($data)
    {
        return self::leftJoin('tools', 'tools.id', '=', 'employee_roles_tools.tool_id')->select('employee_roles_tools.id as id','tools.name as name')->where('employee_roles_tools.er_id', $data['er_id'])->where('employee_roles_tools.category_id', $data['category_id'])->get();
    }
}
