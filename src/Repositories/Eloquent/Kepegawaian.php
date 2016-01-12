<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Kepegawaian extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];

		public function pegawai(){
			return $this->belongsTo(DataPribadi::class,'data_pribadi_id');
		}
		public function pangkat(){
			return $this->belongsTo(DataPangkatDanGolongan::class,'data_pangkat_id');
		}
		public function lembaga_pengangkat(){
			return $this->belongsTo(DataLembagaPengangkat::class,'data_lembaga_pengangkat_id');
		}
		public function sumber_gaji()
		{
			return $this->belongsTo(DataSumberGaji::class,'data_sumber_gaji_id');
		}
		public function status_kepegawaian(){
			return $this->belongsTo(DataStatusKepegawaian::class,'data_status_kepegawaian_id');
		}
		public function ptk()
		{
			return $this->belongsTo(DataPtk::class,'data_ptk_id');
		}

}
