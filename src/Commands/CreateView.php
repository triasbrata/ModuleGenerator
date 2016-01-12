<?php

namespace Bitdev\ModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateView extends Command
{

    protected $path;
    protected $files;
    protected $views = ['index','create','edit','show','form'];
    function __construct(Filesystem $files) 
    {
        $this->path = $_SERVER['PWD'].'/resources/views/';
        $this->files = $files;
        parent::__construct();

    }
    /**
     * The console command name .
     *
     * @var string
     */
    protected $name = 'create:view';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating view ';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected function getStub($name)
    {
        return __DIR__.'/stubs/view//'.$name.'.stub';
    }
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $path = $this->path.str_replace('/_', '/',strtolower(implode('_',array_slice(preg_split('/(?=[A-Z])/',$this->argument('name')), 1))));
        return $path.'/'.$name.'.blade.php';
    }
    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
    public function fire()
    {
        foreach ($this->views as $view) {
            $path = $this->getPath($view);
           if($this->files->exists($path)){
                $this->error("view $view already exists!");
           }
           else{
            $this->makeDirectory($path);
            $this->files->put($path, $this->files->get($this->getStub($view)));
            $this->info("view $view created successfully");
           }

        }
        
    }
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the Controller class'],
        ];
    }
}
