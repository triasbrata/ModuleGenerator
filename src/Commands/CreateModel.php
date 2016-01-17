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
        return $rootNamespace.'\Repositories\\'.$this->getRepo();
    }
    protected function getRepo()
    {
        return ! is_null($this->argument('repo')) ? $this->argument('repo') : 'Eloquent';
    }
    public function getAbstractModelName()
    {
        return $this->argument('abstract') != 'Eloquent' ? 
                    'Illuminate\Database\Eloquent\Model':
                    $this->argument('abstract') ;
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
        return $this->replaceNamespace($stub, $name)->replaceAbstractClass($stub,$this->getAbstractModelName())->replaceClass($stub, $name);
    }

    protected function replaceAbstractClass(&$stub, $name)
    {
        $stub = str_replace('DummyAbstractModel', $name, $stub);
        return $this;
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
