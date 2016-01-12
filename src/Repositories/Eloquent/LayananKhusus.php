<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class LayananKhusus extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];


		public function sekolah(){
			return $this->belongsTo(Sekolah::class);
		}

		public function layanan_khusus(){
			return $this->hasOne(DataLayananKhusus::class,'id','data_layanan_khusus_id');
		}
}
