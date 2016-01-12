<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class SertifikasiIso extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function sekolah(){
			return $this->belongsTo(Sekolah::class,"sekolah_id");
		}
		public function sertifikat(){
			return $this->belongsTo(SertifikatIso::class,"sertifikasi_iso_id");
		}
}
