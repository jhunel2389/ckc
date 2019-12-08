<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Tools;

class ReportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function toolsProficiency(){

    	$data = array(
    		'title' => 'Tools Proficiency Report',
    		'fav_title' => 'Tools Proficiency Report',
    		'side_bar' => 'side_reports',
    		'sub_bar' => 'sub_tool_prof',
            'utils' => Utils::class
    	);

    	return view('pages.report.tools_proficiency_report')->with($data);
    }

    public function trainingStatus(){

    	$data = array(
    		'title' => 'Training Status Report',
    		'fav_title' => 'Training Status Report',
    		'side_bar' => 'side_reports',
    		'sub_bar' => 'sub_training_status',
            'utils' => Utils::class
    	);

    	return view('pages.report.training_status_report')->with($data);
    }

    public function toolsSummaryReport(Request $request){
        return Datatables::of(Tools::toolsSummaryReport())->make(true);
    }

    public function toolsSummaryNameReport(Request $request){
        return Datatables::of(Tools::toolsSummaryNameReport())->make(true);
    }
}
