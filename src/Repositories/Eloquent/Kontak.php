<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Kontak extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function pegawai()
		{
			return $this->belongsTo(DataPribadi::class,'data_pribadi_id');
		}
}
