<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRolesTrainingTools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_roles_training_tools';

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
        return self::leftJoin('training_tools', 'training_tools.id', '=', 'employee_roles_training_tools.tool_id')->select('employee_roles_training_tools.id as id','training_tools.name as name', 'training_tools.id as tool_id', 'training_tools.link as link')->where('employee_roles_training_tools.er_id', $data['er_id'])->get();
    }
}
