<?php 

namespace Bitdev\ModuleGenerator\Commands;
use Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;
use Illuminate\Support\Str;
abstract class GeneratorCommand extends BaseGeneratorCommand {
	protected $app;
	protected $namespace;

	function __construct(Filesystem $file) {
		parent::__construct($file);
		$this->namespace = Config::get('costume.namespace');
	}

	protected function getPath($name)
    {

        $name = str_replace($this->namespace, '', $name);
        return str_finish(Config::get('path.generate.base'),'/').str_replace('\\', '/', $name).'.php';
    }
     protected function parseName($name)
    {
        $rootNamespace = $this->namespace;

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }
}