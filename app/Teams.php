<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create(array $data)
    {
        return self::insert($data);
    }

    public static function updateTeams($id,array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function getTeamList(array $status)
    {
        return self::whereIn('status', $status)->get();
    }

}
