<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile(){
        $user_info = Auth::user();
        
    	$data = array(
    		'title' => 'Profile',
    		'fav_title' => 'CKC | Profile',
            'side_bar' => 'side_profile',
            'user_info' => $user_info,
            'utils' => Utils::class
    	);
        
        //var_dump(Utils::testUtils());die();
    	return view('pages.user.profile')->with($data);
    }

    
}
