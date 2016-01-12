<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Tambahan extends Model implements RepositorieInterface
{
		protected $fillable = ['sekolah_id','mbs','luas_tanah_milik','luas_tanah_sewa','status_kepemilikan_tanah','no_status_kepemilikan_tanah','file_kepemilikan_tanah','npwp','file_npwp'];
		public function kebutuhan_khusus(){
			return $this->belongsToMany(DataKebutuhanKhusus::class);
		}
		public function sekolah(){
			return $this->belongsTo(Sekolah::class);
		}
}
