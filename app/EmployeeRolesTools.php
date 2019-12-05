<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function getList($er_id)
    {
        return self::where('er_id', $er_id)->get();
    }
}
