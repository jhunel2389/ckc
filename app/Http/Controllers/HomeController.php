<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teams;
use App\Tools;
use App\EmployeeRoles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * php artisan make:controller SystemController
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $default = route('profile');
        if(Utils::checkPermissions('view_dashboard')){
            return $this->dashboard();
        }
        return redirect($default);
    }

    public function dashboard(){
        $active_teams = count(Teams::all());
        $active_tools = count(Tools::all());
        $total_reg    = count(User::all());
        $active_roles = count(EmployeeRoles::all());
        $data = array(
            'title'         => 'Dashboard',
            'fav_title'     => 'CKC | Dashboard',
            'side_bar'      => 'side_dashboard',
            'utils'         => Utils::class,
            'active_teams'  => $active_teams,
            'active_tools'  => $active_tools,
            'total_reg'     => $total_reg,
            'active_roles'  => $active_roles
        );

        return view('pages.index')->with($data);
    }
}
