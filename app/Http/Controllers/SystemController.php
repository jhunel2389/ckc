<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use App\User;
use App\Teams;
use App\Tools;
use App\EmployeeRoles;
use App\EmployeeRolesTools;
use App\TeamEmployeeRoles;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function users(){
        
        if(!Utils::permissionsViews('view_users')){
            return redirect(route('home'));
        };

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

        if(!Utils::permissionsViews('view_teams')){
            return redirect(route('home'));
        };

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

        if(!Utils::permissionsViews('add_teams')){
            return redirect(route('home'));
        };

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
        
        Utils::msgAlerts($response);
        return redirect()->route('systemTeams');
    }

    public function updateTeam(Request $request)
    {
        if(!Utils::permissionsViews('edit_teams')){
            return redirect(route('home'));
        };

        $data = array (
            'status'     => $request['status']
        );
        $response = Teams::updateTeams($request['team_status_id'],$data);

        Utils::msgAlerts($response);
        return redirect()->route('systemTeams');
    }

    public function tools(){

        if(!Utils::permissionsViews('view_tools')){
            return redirect(route('home'));
        };

        $list = Tools::getList([self::STATUS_ACTIVE,self::STATUS_DISABLED]);
        
        $data = array(
            'title'     => 'System Tools',
            'fav_title' => 'System Tools',
            'side_bar'  => 'side_system',
            'sub_bar'   => 'sub_tools',
            'utils'     => Utils::class,
            'list' => $list
        );
        
        return view('pages.system.tools')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function tools_validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:tools'],
        ]);
    }

    public function addTool(Request $request){

        if(!Utils::permissionsViews('add_tools')){
            return redirect(route('home'));
        };

        if(empty($request['data_id'])){
            $validator = $this->tools_validator($request->all())->validate();

            $data = array (
                'name'          => $request['name'],
                'description'   => $request['description']
            );
            $response = Tools::create($data);
        } else {
            $data = array (
                'name'          => $request['name'],
                'description'   => $request['description']
            );
            $response = Tools::updateData($request['data_id'],$data);
        }
        
        Utils::msgAlerts($response);
        return redirect()->route('systemTools');
    }

    public function updateTool(Request $request)
    {
        if(!Utils::permissionsViews('edit_tools')){
            return redirect(route('home'));
        };

        $data = array (
            'status'     => $request['status']
        );
        $response = Tools::updateData($request['status_id'],$data);

        Utils::msgAlerts($response);
        return redirect()->route('systemTools');
    }

    public function employeeRoles(){

        if(!Utils::permissionsViews('view_roles')){
            return redirect(route('home'));
        };

        $list = EmployeeRoles::getList([self::STATUS_ACTIVE,self::STATUS_DISABLED]);
        
        $data = array(
            'title'     => 'System Employee Roles',
            'fav_title' => 'System Employee Roles',
            'side_bar'  => 'side_system',
            'sub_bar'   => 'sub_roles',
            'utils'     => Utils::class,
            'list' => $list
        );
        
        //var_dump(Utils::testUtils());die();
        return view('pages.system.employee_roles')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function er_validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:employee_roles'],
        ]);
    }

    public function addEmployeeRoles(Request $request){

        if(!Utils::permissionsViews('add_tools')){
            return redirect(route('home'));
        };

        if(empty($request['data_id'])){
            $validator = $this->er_validator($request->all())->validate();

            $data = array (
                'name'          => $request['name'],
                'description'   => $request['description']
            );
            $response = EmployeeRoles::create($data);
        } else {
            $data = array (
                'name'          => $request['name'],
                'description'   => $request['description']
            );
            $response = EmployeeRoles::updateData($request['data_id'],$data);
        }
        
        Utils::msgAlerts($response);
        return redirect()->route('systemEmployeeRoles');
    }

    public function updateEmployeeRoles(Request $request)
    {
        if(!Utils::permissionsViews('edit_tools')){
            return redirect(route('home'));
        };

        $data = array (
            'status'     => $request['status']
        );
        $response = EmployeeRoles::updateData($request['status_id'],$data);

        Utils::msgAlerts($response);
        return redirect()->route('systemEmployeeRoles');
    }

    public function getTools(Request $request){
        $list = Tools::getAvailableToolsPerER([self::STATUS_ACTIVE],$request['er_id']);
        return $list;
    }


    public function primaryToolsData(Request $request){
        $data = array (
            'er_id'          => $request['er_id'],
            'category_id'    => 1
        );
        return Datatables::of(EmployeeRolesTools::getListByER($data))->make(true);
    }

    public function secondaryToolsData(Request $request){
        $data = array (
            'er_id'          => $request['er_id'],
            'category_id'    => 2
        );
        return Datatables::of(EmployeeRolesTools::getListByER($data))->make(true);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function ertools_ajax_validator(array $data)
    {
        return Validator::make($data, [
            'er_id' => ['required', 'string', 'max:255'],
            'tool_id' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
        ]);
    }

    public function addERToolsData(Request $request){
        $validator = $this->ertools_ajax_validator($request->all())->validate();

        $data = array (
            'er_id'          => $request['er_id'],
            'tool_id'   => $request['tool_id'],
            'category_id'   => $request['category_id']
        );

        $response = EmployeeRolesTools::create($data);
        $response = Utils::msgAlerts($response,"Tools Succesfully Added!",$request->ajax());
        
        return $response;
    }

    public function deleteERToolsData(Request $request){

        $response = EmployeeRolesTools::destroy($request['ert_id']);
        $response = Utils::msgAlerts($response,"Tools Succesfully Remove!",$request->ajax());
        
        return $response;
    }

    public function getTeams(Request $request){
        $list = EmployeeRoles::getAvailableERPerTeam([self::STATUS_ACTIVE],$request['team_id']);
        return $list;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function teamer_ajax_validator(array $data)
    {
        return Validator::make($data, [
            'er_id' => ['required', 'string', 'max:255'],
            'team_id' => ['required', 'string', 'max:255']
        ]);
    }

    public function addTeamsERData(Request $request){
        $validator = $this->teamer_ajax_validator($request->all())->validate();

        $data = array (
            'er_id'          => $request['er_id'],
            'team_id'   => $request['team_id']
        );

        $response = TeamEmployeeRoles::create($data);
        $response = Utils::msgAlerts($response,"Employee Role Succesfully Added!",$request->ajax());
        
        return $response;
    }

    public function teamERData(Request $request){
        $data = array (
            'team_id'          => $request['team_id']
        );
        return Datatables::of(TeamEmployeeRoles::getListByTeam($data))->make(true);
    }

    public function deleteTeamERData(Request $request){

        $response = TeamEmployeeRoles::destroy($request['ter_id']);
        $response = Utils::msgAlerts($response,"Employee Role Succesfully Remove!",$request->ajax());
        
        return $response;
    }
}
