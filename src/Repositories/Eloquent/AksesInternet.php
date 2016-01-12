<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class AksesInternet extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
}
