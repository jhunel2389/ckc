<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeRolesTrainingTools;
class TrainingTools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_tools';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create(array $data)
    {
        return self::insert($data);
    }

    public static function getList(array $status)
    {
        return self::whereIn('status', $status)->get();
    }

    public static function updateData($id,array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function getAvailableToolsPerTraining(array $status,$er_id = null)
    {   
        $tool_by_er_id = EmployeeRolesTrainingTools::where('er_id', '=', $er_id)->pluck('tool_id')->toArray();
        return self::whereIn('status', $status)->whereNotIn('id',$tool_by_er_id)->get();
    }
}
