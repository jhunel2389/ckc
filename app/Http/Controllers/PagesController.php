<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teams;
use App\Roles;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile($id = null){
        if(empty($id)){
            $id = Auth::User()->id;
        }
        $user_info = User::UserInfo($id);
        //var_dump($user_info);die();
        $team_list = Teams::getTeamList([self::STATUS_ACTIVE]);
    	$data = array(
    		'title'     => 'Profile',
    		'fav_title' => 'CKC | Profile',
            'side_bar'  => 'side_profile',
            'user_info' => $user_info,
            'utils'     => Utils::class,
            'team_list' => $team_list
    	);
        
        //var_dump(Utils::testUtils());die();
    	return view('pages.user.profile')->with($data);
    }

    
}
