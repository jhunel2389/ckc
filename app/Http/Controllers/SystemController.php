<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function users(){
        $user_list = User::UserList();
        
    	$data = array(
    		'title' 	=> 'System Users',
    		'fav_title' => 'System Users',
            'side_bar' 	=> 'side_system',
            'sub_bar' 	=> 'sub_users',
            'utils' 	=> Utils::class,
            'user_list'	=> $user_list
    	);
        
        //var_dump(Utils::testUtils());die();
    	return view('pages.system.users')->with($data);
    }
}
