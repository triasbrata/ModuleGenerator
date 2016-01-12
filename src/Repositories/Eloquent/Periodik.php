<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Periodik extends Model implements RepositorieInterface
{
		protected $fillable = ['sekolah_id','tahun_ajaran_id','semester_id','waktu_penyelenggaraan_id','bosna','bosda','sumber_listrik_id','daya','kategori_wilayah_id','wilayah_khusus'];
		public function sekolah()
		{
			return $this->belongsTo(Sekolah::class);
		}
		public function semester()
		{
			return $this->belongsTo(Semester::class);
		}
		public function waktu_penyelenggaraan()
		{
			return $this->belongsTo(WaktuPenyelengaraan::class);
		}
		public function sumber_listrik()
		{
			return $this->belongsTo(SumberListrik::class);
		}
		public function tahun_ajaran(){
			return $this->belongsTo(TahunAjaran::class);
		}
		public function kategori_wilayah()
		{
			return $this->belongsTo(KategoriWilayah::class);
		}
		public function akses_internet()
		{
			return $this->belongsToMany(AksesInternet::class);
		}
		public function getAksesInternetListAttribute()
		{	
			return $this->akses_internet->lists('id')->toArray();
		}
}
