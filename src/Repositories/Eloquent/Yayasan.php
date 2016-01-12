<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Yayasan extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];

		public function provinsi()
		{
			return $this->kelurahan->kecamatan->kabupaten->provinsi();
		}
		public function kabupaten()
		{
			return $this->kelurahan->kecamatan->kabupaten();
		}
		public function kecamatan()
		{
			return $this->kelurahan->kecamatan();
		}
		public function kelurahan()
		{
			return $this->belongsTo(Kelurahan::class);
		}
		public function lists($title,$key)
		{
			$o[0] ="--Pilih salah satu--";
			return $o+parent::lists($title,$key)->toArray();
		}
}
