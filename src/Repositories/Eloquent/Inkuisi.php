<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Inkuisi extends Model implements RepositorieInterface
{
		protected $guarded = ['id'];
	public function kebutuhan_khusus(){
		return $this->belongsToMany(DataKebutuhanKhusus::class);
	}
	public function sekolah(){
		return $this->belongsTo(Sekolah::class);
	}
	public function getKebutuhanKhususListsAttribute()
	{
		return $this->kebutuhan_khusus->lists('id')->toArray();
	}
}
