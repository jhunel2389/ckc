<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Bookmarks;
class GuestController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public static function viewGuestBookmarks(){

    	$data = array (
            'team_id'          => Auth::User()->team,
            'status'           => [self::STATUS_ACTIVE,self::STATUS_DISABLED]
        );

        $list = Bookmarks::getListByTeam($data);
        
        $data = array(
            'list' => $list
        );
    	return view('pages.guest.bookmarks')->with($data);
    }
}
