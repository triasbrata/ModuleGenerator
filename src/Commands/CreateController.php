<?php

namespace Bitdev\ModuleGenerator\Console\Commands;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateController extends GeneratorCommand
{

    /**
     * The console command name .
     *
     * @var string
     */
    protected $name = 'create:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Override make:controller and make request ';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    
    protected $type = 'Controller';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return $this->option('plain') ?
             __DIR__.'/stubs/controller.plain.stub' : 
             __DIR__.'/stubs/controller.stub' ;
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
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
        $nameRequest = is_null($this->argument('request')) ? str_replace([$this->getNamespace($name).'\\','Controller'], '', $name).'Request' :  $this->argument('request');
        return $this->replaceNamespace($stub, $name)->replaceRequest($stub,$nameRequest)->replaceClass($stub, $name);
    }
    protected function replaceRequest(&$stub, $name)
    {
        $stub = str_replace('DummyRequest', $name, $stub);
        $this->call('make:request',['name'=>$name]);
        return $this;
    }
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['plain', null, InputOption::VALUE_NONE, 'Generate an empty controller class.'],
        ];
    }
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['request',InputArgument::OPTIONAL, 'The name of request for injecting to the controller'],
        ];
    }
}
