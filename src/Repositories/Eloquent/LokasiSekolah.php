<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class LokasiSekolah extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
		public function sekolah(){
			return $this->belongsTo(Sekolah::class);
		}
		public function kelurahan(){
			return $this->belongsTo(Kelurahan::class);
		}
		public function getKecamatanAttribute(){
			return $this->kelurahan->kecamatan;
		}
		public function getKabupatenAttribute(){
			return $this->kelurahan->kecamatan->kabupaten;
		}
		public function getProvinsiAttribute(){
			return $this->kelurahan->kecamatan->kabupaten->provinsi;
		}
}
