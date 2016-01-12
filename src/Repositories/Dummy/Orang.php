<?php namespace App\Repositories\Dummy;
use App;
use App\Repositories\RepositorieInterface;
class Orang extends DummyModel implements RepositorieInterface,DummyInterface
{
	protected $dataLenght = 3;
	public function column()
	{
		return [
		'nama' =>'name',
		'email' => 'email',
		'describe' => 'text',
		'pegawai'=>'pegawai'
		];
	}
	public function pegawai()
	{
		return  $this->hasOne(Pegawai::class);
	}
}