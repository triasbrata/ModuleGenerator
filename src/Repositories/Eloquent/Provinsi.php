<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model as Model;
use App\Repositories\RepositorieInterface;

class Provinsi extends Model implements RepositorieInterface
{
		protected $fillable = ['id','title'];
		public function kabupaten()
		{
			return $this->hasMany(Kabupaten::class);
		}
		public function kecamatan()
		{
			return $this->hasManyThrough(Kabupaten::class,Kecamatan::class);
		}
		public function lists($title,$key)
		{
			$o[0] ="--Pilih salah satu--";
			return $o+parent::lists($title,$key)->toArray();
		}
		/**
		 * validation region from provinsi,kabupaten, kecamatan and kelurahan
		 * @return boolean
		 */
		public function validationRequest()
		{
			$args =  func_get_args();
			if(count($args) == 1 ){
				return $this->whrere('id',$args[0])->get()->count() >= 1;
			}
			else{
				return $this->find($args['0'])->whereHas('kabupaten',function ($query) use ($args)
				{
					if(count($args) == 2){
						$query->where('id',$args['1'])->whereHas('kecamatan',function ($query) use ($args)
						{
							if(count($args) == 4){
								$query->where('id',$args[3])->whereHas('kelurahan',function ($query) use ($args)
								{
									$query->where('id',$args[4]);
								});
							}else{
								$query->where('id',$args['2']);
							}
						});
					}else{
						$query->where('id',$args['1']);
					}
				})->get()->count() >= 1;
			}
		}
}
