<?php namespace App\Repositories\Dummy;
interface DummyInterface{
	public function all();
	public function get();
	public function find($id);
	public function where($param,$value);
	public function column();
}