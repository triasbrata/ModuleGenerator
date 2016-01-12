<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class DataPribadi extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function agama()
		{
			return $this->belongsTo(Agama::class);
		}
		public function getNamaAttribute()
		{
			return "{$this->gelar_depan} {$this->gelar_keagamaan} {$this->nama_lengkap} {$this->gelar_belakang}";
		}
		public function jenis_kelamin(){
			return $this->belongsTo(JenisKelamin::class);
		}
		public function kelurahan()
		{
			return $this->belongsTo(Kelurahan::class);
		}
		public function kecamatan()
		{
			return $this->kelurahan->kecamatan();
		}
		public function kabupaten()
		{
			return $this->kecamatan->kabupaten();
		}
		public function provinsi()
		{
			return $this->kabupaten->provinsi();
		}
		public function kepegawaian()
		{
			return $this->hasOne(Kepegawaian::class);
		}
		public function listing()
		{
			$o = ['--Pilih salah satu--'];
			foreach ($this->all() as $d) {
				$o[]= "{$d->gelar_depan} {$d->gelar_keagamaan} {$d->nama_lengkap} {$d->gelar_belakang} - {$d->nik}";
			}
			return $o;
		}
}
