<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Siswa extends Model implements RepositorieInterface
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
		public function jenis_kelamin(){
			return $this->belongsToMany(JenisKelamin::class)->withPivot('jumlah');
		}
		public function agama(){
			return $this->belongsToMany(Agama::class)->withPivot('jumlah');
		}
		public function kebutuhan_khusus(){
			return $this->belongsToMany(DataKebutuhanKhusus::class)->withPivot('jumlah');
		}
}
