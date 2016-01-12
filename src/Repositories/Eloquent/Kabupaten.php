<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Kabupaten extends Model implements RepositorieInterface
{
		protected $fillable = ['id','provinsi_id','title'];
		public function provinsi()
		{
			return $this->belongsTo(Provinsi::class);
		}
		public function lists($title,$key)
		{
			$o[] = "--Pilih salah satu--";
			return array_merge_recursive($o , parent::lists($title,$key)->toArray());
		}
		public function kecamatan()
		{
			return $this->hasMany(Kecamatan::class);
		}
		public function scopeKabupaten($query,$kabupaten,$provinsi)
		{
			return $this->where('id',$kabupaten)->whereHas('provinsi',function ($query) use ($provinsi)
			{
				$query->where('provinsis.id',$provinsi);
			});
		}
}
