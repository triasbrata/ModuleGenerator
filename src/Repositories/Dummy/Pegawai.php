<?php namespace App\Repositories\Dummy;
use App;
use App\Repositories\RepositorieInterface;
class Pegawai extends DummyModel implements RepositorieInterface,DummyInterface
{
	protected $dataLenght = 3;
	public function column()
	{
		return [
		'nama' =>'name',
		'email' => 'email',
		'describe' => 'text',
		];
	}
}