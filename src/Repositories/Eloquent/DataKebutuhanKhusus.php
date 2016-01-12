<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class DataKebutuhanKhusus extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function inkusis(){
			return $this->belongsToMany(Inkuisi::class);
		}
}
