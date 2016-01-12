<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class UnitKerja extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];

		public function pegawai(){
			return $this->belongsTo(DataPribadi::class,'data_pribadi_id');
		}
		public function kecamtan()
		{
			return $this->belongsTo(Kecamatan::class);
		}
		public function sekolah()
		{
			return $this->belongsTo(Sekolah::class);
		}
		public function bentuk_pendidikan(){
			return $this->belongsTo(BentukPendidikan::class,'bentuk_pendidikan_id');
		}
}
