<?php

namespace Bitdev\ModuleGenerator\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
abstract class Controller extends BaseController
{
	protected $removeNamespace = ['Bitdev\\Project\\Http\\Controllers\\','Admin\\','Data\\','Controller','\\'];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ControllerPatch, RoutingController;
}
