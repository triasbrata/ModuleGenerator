<?php

namespace Bitdev\ModuleGenerator;

use Illuminate\Support\ServiceProvider;

use Bitdev\ModuleGenerator\Commands\CreateController;
use Bitdev\ModuleGenerator\Commands\CreateModel;
use Bitdev\ModuleGenerator\Commands\CreateView;
use Bitdev\ModuleGenerator\Commands\CreateRequest;
use Bitdev\ModuleGenerator\Commands\CreateModule;

class GeneratorServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         $this->publishes([
                __DIR__.'/configs/bitdev.php' => config_path('bitdev.php'),
        ]);
         
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCreateController();
        $this->registerCreateModel();
        $this->registerCreateModule();
        $this->registerCreateView();
        $this->registerCreateRequest();
        // to register a command to artisan command
        $this->commands('command.create.controller','command.create.model','command.create.module','command.create.view','command.create.request');
//        $this->mergeConfigFrom(__DIR__.'/configs/bitdev.php','bitdev');

    }
    protected function registerCreateModel()
    {
        $this->app->singleton('command.create.model',function ($app)
        {
            return new CreateModel($app['files'],$app);
        });
    }
    protected function registerCreateModule()
    {
        $this->app->singleton('command.create.module',function ($app)
        {
            return new CreateModule($app['files'],$app);
        });
    }
    protected function registerCreateView()
    {
        $this->app->singleton('command.create.view',function ($app)
        {
            return new CreateView($app['files'],$app);
        });
    }
    protected function registerCreateController()
    {
        $this->app->singleton('command.create.controller',function ($app)
        {
            return new CreateController($app['files'],$app);
        });
    }
    protected function registerCreateRequest()
    {
        $this->app->singleton('command.create.request',function ($app)
        {
            return new CreateRequest($app['files'],$app);
        });
    }
     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.create.controller',
            'command.create.view',
            'command.create.module',
            'command.create.model',
        ];
    }
}
