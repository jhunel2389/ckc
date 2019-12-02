<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $data = array(
            'title' => 'Dashboard',
            'fav_title' => 'CKC | Dashboard',
            'side_bar' => 'side_dashboard',
            'utils' => Utils::class
        );

        return view('pages.index')->with($data);
    }
}
