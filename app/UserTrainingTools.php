<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TrainingTools;
use App\EmployeeRolesTrainingTools;
use App\Tools;
use App\User;
class UserTrainingTools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_training_tools';

    const NOT_YET_STARTED = 1;
    const ON_GOING = 2;
    const COMPLETED = 3;

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

    public static function getInfo(array $data)
    {
        return self::where('user_id', $data['user_id'])->where('tool_id', $data['tool_id'])->where('er_id', $data['er_id'])->first();
    }

    public static function getUserTrainingToolList($user_id,$er_id,$team_id){
    	$data = array(
    		"er_id" => $er_id
    	);
    	$training_tools_list = EmployeeRolesTrainingTools::getListByER($data);
    	$user_training_tools = self::where('user_id',$user_id)->where('er_id',$er_id)->pluck('tool_id')->toArray();
    	if(!empty($training_tools_list)){
    		foreach ($training_tools_list as $key => $value) {
    			if(in_array($value['tool_id'], $user_training_tools)){
    				$data = array (
	                    'user_id'   => (int)$user_id,
	                    'tool_id'   => (int)$value['tool_id'],
	                    'er_id'     => (int)$er_id
	                );
    				$getInfo = self::getInfo($data);
    				if(!empty($getInfo)){
    					$training_tools_list[$key]['status'] = $getInfo['status'];
    				}
    				
    			} else {
    				$training_tools_list[$key]['status'] = self::NOT_YET_STARTED;
    			}
    		}
    	}
    	return $training_tools_list;
    }

    public static function toolsSummaryReport(){
        $training_tools_list = $training_tools_list = EmployeeRolesTrainingTools::all()->groupBy('tool_id')->toArray();
        //echo '<pre>';var_dump($training_tools_list);die();

        $data = array();

        if(!empty($training_tools_list)){
            foreach ($training_tools_list as $training_tools_list_key => $training_tools_list_value) {
                if(!empty($training_tools_list_value)){
                    foreach ($training_tools_list_value as $key => $value) {
                        $user_list = User::where('employee_role_key',$value['er_id'])->pluck('id')->toArray();
                        $not_yet_started = self::whereNotIn('user_id',$user_list)->count();
                        $on_going = self::where('tool_id',$value['tool_id'])->where('er_id',$value['er_id'])->where('status',self::ON_GOING)->count();
                        $completed = self::where('tool_id',$value['tool_id'])->where('er_id',$value['er_id'])->where('status',self::COMPLETED)->count();
                        array_push($data, array(
                                'tool_name'       => TrainingTools::find($value['tool_id'])->name,
                                'er_id'           => $value['er_id'],
                                'not_yet_started' => $not_yet_started,
                                'on_going'        => $on_going,
                                'completed'       => $completed,
                                )
                        );
                    }
                }
            }
        }
//echo '<pre>';var_dump($data);die();
        $response = array();
        $data_collection = collect($data);
        
        foreach ($data as $key => $value) {
            if($data_collection->contains('tool_name', $value['tool_name']))
            {
                //var_dump($value['not_yet_started']);die();
                $response_collection = collect($response);
                //$not_yet_started = $data_collection->sum('not_yet_started');
                if(!$response_collection->contains('tool_name', $value['tool_name'])){
                    array_push($response, array(
                        'tool_name'     => $value['tool_name'],
                        'not_yet_started' => $value['not_yet_started'],
                        'on_going'      => $value['on_going'],
                        'completed'     => $value['completed'],
                    ));
                } else {
                    foreach ($response as $response_key => $response_value) {
                        if($response_value['tool_name'] == $value['tool_name']){
                            $response[$response_key]['not_yet_started'] += $value['not_yet_started'];
                            $response[$response_key]['on_going'] += $value['on_going'];
                            $response[$response_key]['completed'] += $value['completed'];
                        }
                    }
                }
            }  
        }
        //echo '<pre>';var_dump($response);die();
        return $response;
    }

    public static function toolsSummaryNameReport(){
        //$training_tools_list = TrainingTools::all()->groupBy('tool_id')->toArray();
        
        $data = UserTools::join('users','users.id','=','user_tools.user_id')->join('tools','tools.id','=','user_tools.tool_id')->join('teams','teams.id','=','users.team')->join('employee_roles','employee_roles.id','=','users.employee_role_key')->select('users.firstname as firstname',DB::raw('CONCAT(users.firstname," ",users.lastname) as name'),'employee_roles.name as employee_role','teams.team_name as team','tools.name as tool','user_tools.proficiency_rate as rate')->get();
        
        return $data;
    }
}
