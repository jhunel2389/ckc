<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_tools';

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

    public static function getUserToolList($user_id,$tools_category,$er_id)
    {
    	$tool_by_user = self::where('user_id', '=', $user_id)->pluck('tool_id')->toArray();
    	
    	return self::join('tools', 'tools.id', '=', 'user_tools.tool_id')->select('tools.name as name','user_tools.id as id','user_tools.proficiency_rate as proficiency_rate')->get();
    }
}
