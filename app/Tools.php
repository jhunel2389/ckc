<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeRolesTools;
use DB;
use App\UserTools;
use App\TrainingTools;
class Tools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tools';
    const STATUS_ACTIVE = 1;
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

    public static function getAvailableToolsPerER(array $status,$er_id = null)
    {   
        $tool_by_er_id = EmployeeRolesTools::where('er_id', '=', $er_id)->pluck('tool_id')->toArray();
        return self::whereIn('status', $status)->whereNotIn('id',$tool_by_er_id)->get();
    }

    public static function toolsSummaryReport(){
        
        $list = self::getList([self::STATUS_ACTIVE]);
        $data = array();

        if(!empty($list)){
            foreach ($list as $key => $value) {
                $temp_arr= array();
                $temp_arr['tool_name']=$value['name'];
                $p_count = 0;
                for ($i=0; $i <= 5; $i++) { 
                    $temp_arr['p'.$i] = UserTools::where('tool_id',$value['id'])->where('proficiency_rate',$i)->count();
                }
                array_push($data,$temp_arr);
            }
        }
        
        return $data;
    }

    public static function toolsSummaryNameReport(){
        
        
        $data = UserTools::join('users','users.id','=','user_tools.user_id')->join('tools','tools.id','=','user_tools.tool_id')->join('teams','teams.id','=','users.team')->join('employee_roles','employee_roles.id','=','users.employee_role_key')->select('users.firstname as firstname',DB::raw('CONCAT(users.firstname," ",users.lastname) as name'),'employee_roles.name as employee_role','teams.team_name as team','tools.name as tool','user_tools.proficiency_rate as rate')->get();
        
        return $data;
    }

    public static function getAvailableToolsPerTraining(array $status,$er_id = null)
    {   
        $tool_by_er_id = TrainingTools::where('er_id', '=', $er_id)->pluck('tool_id')->toArray();
        return self::whereIn('status', $status)->whereNotIn('id',$tool_by_er_id)->get();
    }
}
