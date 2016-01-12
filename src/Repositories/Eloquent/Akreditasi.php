<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Akreditasi extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function sekolah()
		{
			return $this->belongsTo(Sekolah::class);
		}
		public function lembaga()
		{
			return $this->belongsTo(Lembaga::class);
		}
		public function nilai()
		{
			return $this->belongsTo(Nilai::class);
		}
}
