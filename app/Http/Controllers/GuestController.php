<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmarks;
class GuestController extends Controller
{

    public static function viewGuestBookmarks(){
        $list = Bookmarks::getList([self::STATUS_ACTIVE,self::STATUS_DISABLED]);
        
        $data = array(
            'list' => $list
        );
    	return view('pages.guest.bookmarks')->with($data);
    }
}
