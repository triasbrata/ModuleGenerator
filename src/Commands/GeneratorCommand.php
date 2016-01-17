<?php 

namespace Bitdev\ModuleGenerator\Commands;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;
use Illuminate\Support\Str;
abstract class GeneratorCommand extends BaseGeneratorCommand {
	protected $app;
	protected $namespace;
    protected $basepath;

	function __construct(Filesystem $file, Container $app) {
		parent::__construct($file);
        $this->app = $app;
        
		
	}
    public function fire()
    {
        if(! $this->app['config']->has('bitdev.generate.namespace.project') || 
            empty($this->app['config']->get('bitdev.generate.namespace.project')) ) {
            $this->namespace = $this->app->getNamespace();
            $this->warn('Namespace will defined as '.trim($this->namespace,'\\'));
        }else{
            $this->namespace = $this->app['config']->get('bitdev.generate.namespace.project');
            $this->info('namespace using '.trim($this->namespace,'\\'));
        }
        if(! $this->app['config']->has('bitdev.generate.basepath') || 
            empty($this->app['config']->get('bitdev.generate.basepath')) ) {
            $this->basepath = $this->app['path'];
            $this->warn('Basepath will defined as '.trim($this->basepath,'/'));
        }else{
            $this->basepath = $this->app['config']->get('bitdev.generate.basepath');
            $this->info('basepath using '.trim($this->basepath,'/'));
        }
        parent::fire();
    }
	protected function getPath($name)
    {

        $name = str_replace($this->namespace, '', $name);
        return str_finish($this->basepath,'/').str_replace('\\', '/', $name).'.php';
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