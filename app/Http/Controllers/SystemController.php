<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Teams;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function teams_validator(array $data)
    {
        return Validator::make($data, [
            'team_name' => ['required', 'string', 'max:255', 'unique:teams'],
        ]);
    }

    public function teams(){
        $team_list = Teams::getTeamList([self::STATUS_ACTIVE,self::STATUS_DISABLED]);
        
        $data = array(
            'title'     => 'System Teams',
            'fav_title' => 'System Teams',
            'side_bar'  => 'side_system',
            'sub_bar'   => 'sub_teams',
            'utils'     => Utils::class,
            'team_list' => $team_list
        );
        
        //var_dump(Utils::testUtils());die();
        return view('pages.system.teams')->with($data);
    }

    public function addTeams(Request $request){
        
        if(empty($request['team_id'])){
            $validator = $this->teams_validator($request->all())->validate();

            $data = array (
                'team_name'     => $request['team_name'],
                'description'   => $request['description']
            );
            $response = Teams::create($data);
        } else {
            $data = array (
                'team_name'     => $request['team_name'],
                'description'   => $request['description']
            );
            $response = Teams::updateTeams($request['team_id'],$data);
        }
        
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
        return redirect()->route('systemTeams');
    }

    public function updateTeam(Request $request)
    {
        $data = array (
            'status'     => $request['status']
        );
        $response = Teams::updateTeams($request['team_status_id'],$data);

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
        return redirect()->route('systemTeams');
    }

    public function employeeRoles(){
        $user_list = User::UserList();
        
        $data = array(
            'title'     => 'System Employee Roles',
            'fav_title' => 'System Employee Roles',
            'side_bar'  => 'side_system',
            'sub_bar'   => 'sub_roles',
            'utils'     => Utils::class,
            'user_list' => $user_list
        );
        
        //var_dump(Utils::testUtils());die();
        return view('pages.system.employee_roles')->with($data);
    }

    public function tools(){
        $user_list = User::UserList();
        
        $data = array(
            'title'     => 'System Tools',
            'fav_title' => 'System Tools',
            'side_bar'  => 'side_system',
            'sub_bar'   => 'sub_tools',
            'utils'     => Utils::class,
            'user_list' => $user_list
        );
        
        //var_dump(Utils::testUtils());die();
        return view('pages.system.tools')->with($data);
    }
}