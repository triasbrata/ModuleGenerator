<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Perizinan extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function sekolah(){
			return $this->belongsTo(Sekolah::class);
		}
}
