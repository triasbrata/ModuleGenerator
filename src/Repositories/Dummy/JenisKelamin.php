<?php namespace App\Repositories\Dummy;
use App;
use App\Repositories\RepositorieInterface;
class JenisKelamin extends DummyModel implements RepositorieInterface,DummyInterface
{
	protected $dataLenght = 5;
	public function column()
	{
		return [
		'title' =>'sex',
		'id' => 'id'
		];
	}
	
	public function sex()
	{
		return ['Laki-Laki','Perempuan'];
	}
}