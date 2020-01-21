<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TrainingTools;
use App\EmployeeRolesTrainingTools;
use App\Tools;
use App\User;
use App\TeamEmployeeRoles;
use App\Teams;
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

    public static function getTrainingByER(){
        $training_tools_list = $training_tools_list = EmployeeRolesTrainingTools::all()->groupBy('tool_id')->toArray();

        $data = array();

        if(!empty($training_tools_list)){
            foreach ($training_tools_list as $training_tools_list_key => $training_tools_list_value) {
                if(!empty($training_tools_list_value)){
                    foreach ($training_tools_list_value as $key => $value) {
                        $started_users = self::where('er_id',$value['er_id'])->where('tool_id',$value['tool_id'])->pluck('user_id')->toArray();

                        $not_yet_started = User::whereNotIn('id',$started_users)->where('employee_role_key',$value['er_id'])->count();
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

        return $data;
    }

    public static function TrainingToolsSummaryReport(){
        
        $data = self::getTrainingByER();

        $response = array();
        if(!empty($data)){
            $data_collection = collect($data);
        
            foreach ($data as $key => $value) {
                if($data_collection->contains('tool_name', $value['tool_name']))
                {
                    $response_collection = collect($response);
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
        }
        
        //echo '<pre>';var_dump($response);die();
        return $response;
    }

    public static function TrainingToolsSummaryTeamReport(){

        $training_tools_list = $training_tools_list = EmployeeRolesTrainingTools::all()->groupBy('tool_id')->toArray();

        $data = array();

        if(!empty($training_tools_list)){
            foreach ($training_tools_list as $training_tools_list_key => $training_tools_list_value) {
                if(!empty($training_tools_list_value)){
                    foreach ($training_tools_list_value as $key => $value) {
                        $by_er = TeamEmployeeRoles::getListByER($value['er_id']); 
                        //echo '<pre>';var_dump($by_er);die();
                        if(!empty($by_er)){
                            foreach ($by_er as $by_er_key => $by_er_value) {
                                $started_users = self::where('er_id',$value['er_id'])->where('tool_id',$value['tool_id'])->pluck('user_id')->toArray();

                                $not_yet_started = User::whereNotIn('id',$started_users)->where('employee_role_key',$value['er_id'])->where('team',$by_er_value['team_id'])->count();
                                $on_going = self::where('tool_id',$value['tool_id'])->where('er_id',$value['er_id'])->where('team_id',$by_er_value['team_id'])->where('status',self::ON_GOING)->count();
                                $completed = self::where('tool_id',$value['tool_id'])->where('er_id',$value['er_id'])->where('team_id',$by_er_value['team_id'])->where('status',self::COMPLETED)->count();
                                array_push($data, array(
                                        'tool_name'       => TrainingTools::find($value['tool_id'])->name,
                                        'team'            => Teams::find($by_er_value['team_id'])->team_name,
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
            }
        }
        
        $response = array();
        if(!empty($data)){
            $data_collection = collect($data);
        
            foreach ($data as $key => $value) {
                if($data_collection->contains('tool_name', $value['tool_name']))
                {
                    $response_collection = collect($response);
                    if(!$response_collection->contains('tool_name', $value['tool_name']) || !$response_collection->contains('team', $value['team'])){
                        array_push($response, array(
                            'tool_name'         => $value['tool_name'],
                            'team'              => $value['team'],
                            'not_yet_started'   => $value['not_yet_started'],
                            'on_going'          => $value['on_going'],
                            'completed'         => $value['completed'],
                        ));
                    } else {
                        foreach ($response as $response_key => $response_value) {
                            if($response_value['tool_name'] == $value['tool_name'] && $response_value['team'] == $value['team']){
                                $response[$response_key]['not_yet_started'] += $value['not_yet_started'];
                                $response[$response_key]['on_going'] += $value['on_going'];
                                $response[$response_key]['completed'] += $value['completed'];
                            }
                        }
                    }
                }  
            }
        }
        
        return $response;
    }

    public static function TrainingToolsSummaryNameReport(){

        $training_tools_list = $training_tools_list = EmployeeRolesTrainingTools::all()->groupBy('tool_id')->toArray();

        $data = array();

        if(!empty($training_tools_list)){
            foreach ($training_tools_list as $training_tools_list_key => $training_tools_list_value) {
                if(!empty($training_tools_list_value)){
                    foreach ($training_tools_list_value as $key => $training_tools_value) {
                        $started_users = self::where('er_id',$training_tools_value['er_id'])->where('tool_id',$training_tools_value['tool_id'])->pluck('user_id')->toArray();

                        $not_yet_started = User::whereNotIn('id',$started_users)->where('employee_role_key',$training_tools_value['er_id'])->get();
                        $on_going = self::where('tool_id',$training_tools_value['tool_id'])->where('er_id',$training_tools_value['er_id'])->where('status',self::ON_GOING)->get();
                        $completed = self::where('tool_id',$training_tools_value['tool_id'])->where('er_id',$training_tools_value['er_id'])->where('status',self::COMPLETED)->get();

                        if (!empty($not_yet_started)) {
                            foreach ($not_yet_started as $key => $value) {
                                array_push($data, array(
                                        'tool_name'       => TrainingTools::find($training_tools_value['tool_id'])->name,
                                        'team'           => Teams::find($value['team'])->team_name,
                                        'user_name' => $value['firstname'].' '.$value['lastname'],
                                        'status'        => "Not Yet Started"
                                        )
                                );
                            }
                            
                        }

                        if (!empty($on_going)) {
                            foreach ($on_going as $key => $value) {
                                array_push($data, array(
                                        'tool_name'       => TrainingTools::find($value['tool_id'])->name,
                                        'team'           => Teams::find($value['team_id'])->team_name,
                                        'user_name' => User::find($value['user_id'])->firstname.' '.User::find($value['user_id'])->lastname,
                                        'status'        => "On Going"
                                        )
                                );
                            }
                            
                        }

                        if (!empty($completed)) {
                            foreach ($completed as $key => $value) {
                                array_push($data, array(
                                        'tool_name'       => TrainingTools::find($value['tool_id'])->name,
                                        'team'           => Teams::find($value['team_id'])->team_name,
                                        'user_name' => User::find($value['user_id'])->firstname.' '.User::find($value['user_id'])->lastname,
                                        'status'        => "Completed"
                                        )
                                );
                            }
                            
                        }
                        
                    }
                }
            }
        }

        return $data;
    }
}
