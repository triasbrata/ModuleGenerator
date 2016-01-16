<?php

namespace Bitdev\ModuleGenerator\Commands;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateModule extends Command
{

    /**
     * The console command name .
     *
     * @var string
     */
    protected $name = 'create:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Controller,Model,View and Request in 1 Command Line ';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected function getControllerName()
    {
       return $this->argument('controller');
    }
    protected function getModelname()
    {
       if(is_null($this->argument('model')) ){
        return array_slice(explode('/', str_replace('Controller', '', $this->argument('controller'))), -1)[0];
       }
        return $this->argument('model');
    }
    protected function getView()
    {
      return str_replace('Controller', '', $this->argument('controller'));
    }
    public function fire()
    {
        if(is_null($this->argument('request'))){
            $this->info('Generate controller and Request class');
            $this->call('create:controller',['name'=>$this->getControllerName()]);
        }else{
            $this->info('Generate controller and Request class');
            $this->call('create:controller',['name'=>$this->getControllerName(),'request'=>$this->argument('request')]);
        }
        if( is_null($this->argument('repo')) ){
            if(is_null($this->argument('abstract'))){
                $this->info('Generate model class');
                $this->call('create:model',[ 
                    'name' => $this->getModelname(),
                    'repo' => $this->argument('repo'),
                    'abstract' => $this->argument('abstract'),
                    '--migration'=>true
                ]);
            }
            else
            {
                $this->info('Generate model class');
                $this->call('create:model',[ 
                    'name' => $this->getModelname(),
                    'repo' => $this->argument('repo'),
                    '--migration'=>true
                ]);
            }
        }else{
            $this->info('Generate model class');
            $this->call('create:model',[ 'name' => $this->getModelname(),'--migration'=>true ]);
        }
        $this->info('Generate view');
        $this->call('create:view',[
            'name' => $this->getView()
        ]);
    }
    protected function getArguments()
    {
        return [
            ['controller', InputArgument::REQUIRED, 'The name of the class controller'],
            ['request',InputArgument::OPTIONAL, 'The name of request for injecting to the controller'],
            ['model', InputArgument::OPTIONAL, 'The name of the class model'],
            ['repo',InputArgument::OPTIONAL, 'The name of repositories'],
            ['abstract',InputArgument::OPTIONAL, 'The name of model abstract class '],

        ];
    }
}
