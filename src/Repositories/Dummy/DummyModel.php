<?php namespace App\Repositories\Dummy;
use Faker\Factory;
use Illuminate\Support\Collection;
use App;
abstract class DummyModel{
	protected $dataLenght;
	private $limit;
	private $res;
	private $resevedID = [];
	function __construct() {}
	public function id()
	{
		return uniqid();
	}
	public function __toString()
	{
		return json_encode($this->items);
	}
	public function __get($property)
	{
		if(!property_exists($this,$property)){
			if (isset($this->items->{$property})) {
				return $this->items->{$property};
			}else{

				if(method_exists($this,$property)){
					$callback  = $this->{$property}();
					if(is_array($callback)){
						return array_rand($callback);
					}	
					return $callback;
				}
			}
			return null;
		}else{
			return $this->property;
		}
	}
	public function __call($method,$args)
	{
		echo "$method";
		return call_user_func_array([$this,$method], $args);
	}
	public function render()
	{
		$data = Factory::create();
		$render = [];
		for ($i=0; $i < $this->dataLenght ; $i++) { 
			foreach ($this->column() as $field => $attribute) {
				if(property_exists($data,$attribute)){
					$temp[$field] =  property_exists($data, $attribute) ? $data->{$attribute} : $data->name;
				}else{
					if(method_exists($this, $attribute)){
						$res = $this->{$attribute}();
						if(is_array($res)){
							shuffle($res);
							$res = array_slice($res,1)[0];
						}
						$temp[$field] =$res;
					}else{
						$temp[$field] = $data->name;
					}
				}
			}
			// dd($temp);
			$render[] = $this->setItemToClass($temp);
			unset($temp);
		}
		$this->res = $render;
	}
	public function setItemToClass($arr = [])
	{
	 	$class = App::make(get_called_class());
	 	$class->items = new \Stdclass;
	 	foreach ($arr as $key => $value) {
	 		$class->items->{$key} = $value;
	 	}
	 	return $class;
	}
	public function get()
	{
		$this->limit(20)->_get();
	}
	private function _get()
	{
		$this->render();
		if(! is_null($this->limit) ) $this->slice();
		return Collection::make($this->res);
	}
	public function slice()
	{
		$this->res = array_slice($this->res,0,$this->limit);
	}
	public function limit($limit)
	{
		$this->limit = $limit;
		return $this;
	}
	public function all()
	{
		return $this->_get();
	}
	public function find($id)
	{
		return $this->limit(1)->_get();
	}
	public function where($param,$value)
	{
		return ;
	}
	public function hasMany($class)
	{
		$class = $this->getInstance($class);
		if($class instanceOf DummyModel){
			return $class->all();
		}
		throw new Exception("Error Processing Request", 1);
	}
	public function hasOne($class)
	{
		$class = $this->getInstance($class);
		if($class instanceOf DummyModel){
			return $class->limit(1)->get()->first();
		}
		throw new Exception("Error Processing Request", 1);
	}
	public function getInstance($class)
	{
		return App::make($class);
	}
}