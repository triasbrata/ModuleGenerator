<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Sekolah extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function bentuk_pendidikan()
		{
			return $this->belongsTo(BentukPendidikan::class);
		}
		public function status_sekolah()
		{
			return $this->belongsTo(StatusSekolah::class);
		}
		public function status_kepemilikan()
		{
			return $this->belongsTo(StatusKepemilikan::class);
		}
		public function yayasan()
		{
			return $this->belongsTo(Yayasan::class);
		}
		public function lists($title,$key)
		{
			$o[0] ="--Pilih salah satu--";
			return $o+parent::lists($title,$key)->toArray();
		}

}
