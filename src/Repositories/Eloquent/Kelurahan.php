<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Kelurahan extends Model implements RepositorieInterface
{
		protected $fillable = ['id','title','kecamatan_id'];
		public function kecamatan()
		{
			return $this->belongsTo(Kecamatan::class);
		}
		public function lists($title,$key)
		{
			$o[] = "--Pilih salah satu--";
			return array_merge_recursive($o , parent::lists($title,$key)->toArray());
		}
		public function provinsi()
		{
			return $this->kecamatan->kabupaten->provinsi();
		}
		public function kabupaten()
		{
			return $this->kecamatan->kabupaten();
		}
		public function lokasi_sekolah()
		{
			return $this->hasMany(LokasiSekolah::class);
		}
}
