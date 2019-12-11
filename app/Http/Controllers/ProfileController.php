<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Teams;
use App\Roles;
use App\EmployeeRolesTools;
use App\UserTools;
use App\UserTrainingTools;
use App\EmployeeRolesTrainingTools;
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
        $primary_tools = EmployeeRolesTools::getUnusedTools(array (
            'er_id'          => $user_info['employee_role_key'],
            'category_id'    => self::PRIMARY_TOOLS,
            'user_id'        => $user_info['id']
        ));

        $secondary_tools = EmployeeRolesTools::getUnusedTools(array (
            'er_id'          => $user_info['employee_role_key'],
            'category_id'    => self::SECONDARY_TOOLS,
            'user_id'        => $user_info['id']
        ));

        $primary_tools_list = UserTools::getUserToolList($id,self::PRIMARY_TOOLS,$user_info['employee_role_key']);

        $secondary_tools_list = UserTools::getUserToolList($id,self::SECONDARY_TOOLS,$user_info['employee_role_key']);
        
        $training_tools_list = UserTrainingTools::getUserTrainingToolList($id,$user_info['employee_role_key'],$user_info['team']);

        $data = array(
            'title'                 => 'Profile',
            'fav_title'             => 'CKC | Profile',
            'side_bar'              => 'side_profile',
            'user_info'             => $user_info,
            'utils'                 => Utils::class,
            'team_list'             => $team_list,
            'role_list'             => $role_list,
            'primary_tools'         => $primary_tools,
            'primary_tools_list'    => $primary_tools_list,
            'secondary_tools'       => $secondary_tools,
            'secondary_tools_list'  => $secondary_tools_list,
            'training_tools_list'   => $training_tools_list
        );
        //var_dump($user_info);die();
        return view('pages.user.profile')->with($data);
    }

    public function userProfile(int $id){

        if(!Utils::permissionsViews('view_user_profile')){
            return redirect(route('home'));
        };
        
        return $this->profile($id);
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
            'firstname'             => $request['firstname'],
            'lastname'              => $request['lastname'],
            'site_location'         => $request['site_location'],
            'shift'                 => $request['shift'],
            'team'                  => $request['team'],
            'accenture_exp'         => $request['accenture_exp'],
            'working_exp'           => $request['working_exp'],
            'role_key'              => $request['role_key'],
            'employee_role_key'     => $request['er_key'],
        );
        if(empty($request['team']) || empty($request['er_key'])){
            unset($data['team']);
            unset($data['employee_role_key']);
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function user_pri_tools_validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'string', 'max:255'],
            'tool_id' => ['required', 'string', 'max:255'],
            'proficiency_rate' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function user_sec_tools_validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'string', 'max:255'],
            'sec_tool_id' => ['required', 'string', 'max:255'],
            'sec_proficiency_rate' => ['required', 'string', 'max:255']
        ]);
    }

    public function addUserPrimTools(Request $request){
        $validator = $this->user_pri_tools_validator($request->all())->validate();

        $data = array (
            'user_id'   => $request['user_id'],
            'tool_id'   => $request['tool_id'],
            'proficiency_rate'   => $request['proficiency_rate']
        );

        $response = UserTools::create($data);
        $response = Utils::msgAlerts($response);
        
        return redirect()->back();
    }

    public function addUserSecTools(Request $request){
        $validator = $this->user_sec_tools_validator($request->all())->validate();

        $data = array (
            'user_id'   => $request['user_id'],
            'tool_id'   => $request['sec_tool_id'],
            'proficiency_rate'   => $request['sec_proficiency_rate']
        );

        $response = UserTools::create($data);
        $response = Utils::msgAlerts($response);
        
        return redirect()->back();
    }

    public function deleteUserTools(Request $request){
        $response = UserTools::destroy($request['user_tool_id']);
        $response = Utils::msgAlerts($response);
        
        return redirect()->back();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function user_training_tools_validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'string', 'max:255'],
            'tool_id' => ['required', 'string', 'max:255'],
            'action_event' => ['required', 'string', 'max:255']
        ]);
    }

    public function updateStatusTrainingTools(Request $request){
        $validator = $this->user_training_tools_validator($request->all())->validate();

        $user_info = User::UserInfo($request['user_id']);
        

        if(!empty($user_info)){
            $data = array (
                    'user_id'   => (int)$user_info['id'],
                    'tool_id'   => (int)$request['tool_id'],
                    'er_id'     => (int)$user_info['employee_role_key'],
                    'status'    => (int)$request['action_event']
                );
            $userTrainingToolInfo = UserTrainingTools::getInfo($data);
            switch ($request['action_event']) {
                case UserTrainingTools::ON_GOING:
                    if(empty($userTrainingToolInfo)){
                        $response =   UserTrainingTools::create($data);
                    } else {
                        $response =   UserTrainingTools::updateData($userTrainingToolInfo['id'],$data);
                    }
                    break;
                case UserTrainingTools::COMPLETED:
                    $response =   UserTrainingTools::updateData($userTrainingToolInfo['id'],$data);
                    break;
                case UserTrainingTools::NOT_YET_STARTED:
                    $response =   UserTrainingTools::destroy($userTrainingToolInfo['id']);
                    break;
                default:
                    $response = null;
                    break;
            }
           
        }
        
        
        $response = Utils::msgAlerts($response);

        return redirect()->back();
    }
}
