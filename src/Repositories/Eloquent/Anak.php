<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Anak extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function pegawai(){
			return $this->belongsTo(DataPribadi::class,'data_pribadi_id');
		}
		public function jenis_kelamin()
		{
			return $this->belongsTo(JenisKelamin::class,'jenis_kelamin_id');
		}
}
