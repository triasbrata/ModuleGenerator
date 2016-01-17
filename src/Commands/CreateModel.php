<?php

namespace Bitdev\ModuleGenerator\Commands;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateModel extends GeneratorCommand
{

    /**
     * The console command name .
     *
     * @var string
     */
    protected $name = 'create:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Override make:model ';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    
    protected $type = 'Model';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return __DIR__.'/stubs/model.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if($this->app['config']->has('bitdev.generated.namespace.model'))
            return $rootNamespace."\\".$this->app['config']->get('bitdev.generated.namespace.model');
        return $rootNamespace;
    }
    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        if ($this->option('migration')) {
            $table = Str::plural(Str::snake(class_basename($this->argument('name'))));
            $this->call('make:migration', ['name' => "create_{$table}_table", '--create' => $table]);

        }
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
    protected function getOptions()
    {
        return[
             ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
        ];
    }
}
