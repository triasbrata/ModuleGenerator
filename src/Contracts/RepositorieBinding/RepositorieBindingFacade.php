<?php namespace App\Providers\Contracts\RepositorieBinding;

use Illuminate\Support\Facades\Facade;
class RepositorieBindingFacade  extends Facade
{
	protected static function getFacadeAccessor() { return 'RepoBind'; }
}
