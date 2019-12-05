<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;
use App\Teams;
use App\Roles;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $team_list = Teams::getTeamList([self::STATUS_ACTIVE]);
        $role_list = Roles::all();
        $data = array(
            'title'     => 'Profile',
            'fav_title' => 'CKC | Profile',
            'side_bar'  => 'side_profile',
            'user_info' => $user_info,
            'utils'     => Utils::class,
            'team_list' => $team_list,
            'role_list' => $role_list
        );
        //var_dump($user_info);die();
        return view('pages.user.profile')->with($data);
    }

    public function userProfile(int $id){

        if(!Utils::checkPermissions('view_user_profile')){
            return redirect(route('home'));
        }
        return $this->profile($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = array (
            'firstname'     => $request['firstname'],
            'lastname'      => $request['lastname'],
            'site_location' => $request['site_location'],
            'shift'         => $request['shift'],
            'team'          => $request['team'],
            'accenture_exp' => $request['accenture_exp'],
            'working_exp'   => $request['working_exp'],
            'role_key'   => $request['role_key'],
        );
        if(empty($request['team'])){
            unset($data['team']);
        }
        
        if(empty($request['role_key'])){
            unset($data['role_key']);
        }
        
        $response = User::UpdateInfo($request['username'],$data);
        if($response){
            $message_alert = array(
                'alert_status'    => "success",
                'alert_msg'       => "Successful!",
                'alert_class'     => "bg-success"
            );
        } else {
            $message_alert = array(
                'alert_status'    => "error",
                'alert_msg'       => "Error occur, please try again!",
                'alert_class'     => "bg-danger"
            );
        }
        Cache::add('alert_status', $message_alert['alert_status'], 2);
        Cache::add('alert_msg', $message_alert['alert_msg'], 2);
        Cache::add('alert_class', $message_alert['alert_class'], 2);
        if( Auth::User()->username != $request['username'] ) {
            return redirect()->back();
        } else {
            return redirect()->route('profile'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
