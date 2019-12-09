<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;

class AjaxController extends Controller
{
    public function getActiveTeams(){
        return Teams::getTeamList([self::STATUS_ACTIVE]);
    }
}
