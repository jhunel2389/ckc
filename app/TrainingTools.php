<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function getListByER($data)
    {
        return self::leftJoin('tools', 'tools.id', '=', 'training_tools.tool_id')->select('training_tools.id as id','tools.name as name', 'tools.id as tool_id', 'training_tools.link as link')->where('training_tools.er_id', $data['er_id'])->get();
    }
}
