<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tools';

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
}
