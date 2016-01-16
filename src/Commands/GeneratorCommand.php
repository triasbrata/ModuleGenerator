<?php 

namespace Bitdev\ModuleGenerator\Commands;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;
use Illuminate\Support\Str;
abstract class GeneratorCommand extends BaseGeneratorCommand {
	protected $app;
	protected $namespace;

	function __construct(Filesystem $file, Container $app) {
		parent::__construct($file);
        $this->app = $app;
        if(! $this->app['config']->has('bitdev.generate.namespace.project')) throw new Exception("Namespace not define", 1);
		$this->namespace = $this->app['config']->get('bitdev.generate.namespace');
	}

	protected function getPath($name)
    {

        $name = str_replace($this->namespace, '', $name);
        if(! $this->app['config']->has('bitdev.generate.basepath')) throw new Exception("Basepath not define", 1);
        $base_path = $this->app['config']->get('bitdev.generate.basepath');
        return str_finish($base_path,'/').str_replace('\\', '/', $name).'.php';
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