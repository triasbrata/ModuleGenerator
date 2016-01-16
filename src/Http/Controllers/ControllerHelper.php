<?php namespace Bitdev\ModuleGenerator\Http;
trait ControllerHelper{

	private function getDefaultRequestNamespace(){
		$raw = $this->getDefault('requestNamespace','namespace.request');
		return $this->namespaceChecker($raw);
		
	}
	private function namespaceChecker($string)
	{
		if(! is_null($string)){
			if(Str::contains($string,'/')){
				$string = str_replace('/','\\',$string);
			}
			return str_finish($string,'\\');	
		}
		return $string;
	}
	private function getModelNamespace()
	{
		$raw = $this->getDefault('modelNamespace','namespace.model');
		return $this->namespaceChecker($raw);
	}
	private function getDefault($property,$config)
	{
		if(property_exists($this,$property)){
			return $this->{$property};
		}
		elseif($this->app['config']->has('bitdev'.$config)){
			return $this->app['config']->get('bitdev'.$config);
		}
		return null;
	}
	private function getRemoveNamespace()
	{
		return $this->getDefault('removeNamespace','namespace.remove');
	}
	private function getPrefix()
	{
		$removePrefix = $this->getDefault('removePrefix','prefix.default');
		$raw = get_called_class();
		$raw = str_replace($this->removePrefix(), '',$raw);
		$raw = Str::snake($raw,'_');
		$raw = str_replace('\\_','.',$raw);
		return $raw;
	}
	private function generateModuleName(){
		$search = $this->getDefault('searchModuleName','modulename.search');
		$replacer = $this->getDefault('replacerModuleName','modulename.replacer');
		$raw = implode(' ',preg_split('/(?=[A-Z])/',str_replace($this->getRemoveNamespace(), '', get_called_class())));
		return str_replace($search,$replacer,$raw);
	}
	
	/**
	 * 
	 * @param  string $index [description]
	 * @return [type]        [description]
	 */
	protected function uri($index = "")
	{
	    $out = [
	        'index' => "{$this->prefix}.index",
	        'create' => "{$this->prefix}.create",
	        'store' => "{$this->prefix}.store",
	        'edit' => "{$this->prefix}.edit",
	        'update' => "{$this->prefix}.update",
	        'destroy' => "{$this->prefix}.destroy",
	        'show' => "{$this->prefix}.show",
	    ];
	    return isset($out[$index]) ? $out[$index] : $out;
	}
	private function with($data)
	{
		$this->data = $data;
		return $this;
	}
}