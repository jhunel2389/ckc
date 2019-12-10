<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const TRUE = true;
    const FALSE = false;
    const SUPERADMIND = 'superadmin';
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 0;
    const PRIMARY_TOOLS = 1;
    const SECONDARY_TOOLS = 2;

    const NOT_YET_STARTED = 1;
    const ON_GOING = 2;
    const COMPLETED = 3;
}
