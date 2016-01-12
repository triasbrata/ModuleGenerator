<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class DataLayananKhusus extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];

		public function layanan_khusus(){
			return $this->hasMany(LayananKhusus::class);
		}
}
