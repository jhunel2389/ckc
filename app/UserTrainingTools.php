<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TrainingTools;
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
    	$training_tools_list = TrainingTools::getListByER($data);
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
}
