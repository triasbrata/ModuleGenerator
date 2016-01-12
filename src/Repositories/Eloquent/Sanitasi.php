<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Sanitasi extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function sekolah(){
			return $this->belongsTo(Sekolah::class);
		}
		public function tahun_ajaran(){
			return $this->belongsTo(TahunAjaran::class);
		}
		public function semester(){
			return $this->belongsTo(Semester::class);
		}
		public function suplai_air(){
			return $this->belongsTo(SuplaiAir::class);
		}
}
