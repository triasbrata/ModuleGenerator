<?php

namespace Bitdev\ModuleGenerator\Http\Controllers;

use Bitdev\ModuleGenerator\Contracts\ModelInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
    //implements BitdevControllerInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ControllerPatch, RoutingController;

}
