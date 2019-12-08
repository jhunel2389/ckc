<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserTools;
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
        return self::leftJoin('tools', 'tools.id', '=', 'employee_roles_tools.tool_id')->select('employee_roles_tools.id as id','tools.name as name', 'tools.id as tool_id')->where('employee_roles_tools.er_id', $data['er_id'])->where('employee_roles_tools.category_id', $data['category_id'])->get();
    }

    public static function getUnusedTools($data){
        $tool_by_user = UserTools::where('user_id', '=', $data['user_id'])->pluck('tool_id')->toArray();

        return self::leftJoin('tools', 'tools.id', '=', 'employee_roles_tools.tool_id')->select('employee_roles_tools.id as id','tools.name as name', 'tools.id as tool_id')->where('employee_roles_tools.er_id', $data['er_id'])->where('employee_roles_tools.category_id', $data['category_id'])->whereNotIn('employee_roles_tools.tool_id', $tool_by_user)->get();
    }
}
