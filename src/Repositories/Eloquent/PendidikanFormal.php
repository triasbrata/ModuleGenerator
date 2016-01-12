<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class PendidikanFormal extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function pegawai(){
			return $this->belongsTo(DataPribadi::class,'data_pribadi_id');
		}
		public function jenjang_pendidikan(){
			return $this->belongsTo(DataJenjangPendidikan::class,'data_jenjang_pendidikan_id');
		}
		public function gelar(){
			return $this->belongsTo(DataGelarAkademik::class,'data_gelar_pendidikan_id');
		}
		public function bidang_studi(){
			return $this->belongsTo(DataBidangStudi::class,'data_bidang_studi_id');
		}
}
