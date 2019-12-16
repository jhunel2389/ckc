<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_images';

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
        return self::whereIn('type', $status)->get();
    }

    public static function userAvatar($user_id){
    	return self::where('type', 1)->where('user_id', $user_id)->pluck('file_name')->first();
    }

    public static function updateAvatar($data){
        return self::where('type', 1)->where('user_id', $data['user_id'])->update(['file_name' => $data['file_name']]);
    }

    public static function updateData($id,array $data)
    {
        return self::where('id', $id)->update($data);
    }
}
