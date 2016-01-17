<?php namespace Bitdev\ModuleGenerator\Http;
trait ControllerHelper{

	private function getDefaultRequestNamespace(){
		$raw = $this->getDefault('requestNamespace','namespace.request');
		if(is_null($raw) || empty($raw)){
			$raw = $this->app->getNamespace().'\\Http\\Controllers\\Request';
		}
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
		elseif($this->app['config']->has('bitdev.generator'.$config)){
			return $this->app['config']->get('bitdev.generator'.$config);
		}
		return null;
	}

	private function getRemoveNamespace()
	{
		return $this->getDefault('removeNamespace','namespace.remove.modulename');
	}

	private function getPrefix()
	{
		
		$raw = get_called_class();
		$raw = str_replace($this->removePrefix(), '',$raw);
		$raw = Str::snake($raw,'_');
		$raw = str_replace('\\_','.',$raw);
		return $this->prefixFixer($raw);
	}
	private function prefixFixer($prefix)
	{
		if( !is_array($this->getDefault('prefixFixer','prefixFixer')) )
		 throw new Exception("Error Prefix fixer must be array()", 1);
		foreach ($this->getDefault('prefixFixer','prefixFixer') as $key => $value) {
			$search[] = $key;
			$replacer[] = $value;
		}
		return str_replace($search,$replacer,$prefix);

	}
	public function removePrefix()
	{
		return $this->getDefault('removePrefix','namespace.remove.prefix');
	}

	private function generateModuleName(){
		if(!is_array($this->getDefault('replacerModuleName','modulename'))){
			throw new Exception("Error Replacer Module Name must be array()", 1);
			
		}
		foreach ($this->getDefault('replacerModuleName','modulename') as $key => $value) {
			$search[] = $key;
			$replacer[] = $value;
		}
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