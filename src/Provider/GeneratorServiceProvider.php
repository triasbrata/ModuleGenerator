<?php

namespace Bitdev\ModuleGenerator\Providers;

use Illuminate\Support\ServiceProvider;

use Bitdev\ModuleGenerator\Console\Commands\CreateController;
use Bitdev\ModuleGenerator\Console\Commands\CreateModel;
use Bitdev\ModuleGenerator\Console\Commands\CreateView;
use Bitdev\ModuleGenerator\Console\Commands\CreateModule;

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
        //
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
        // to register a command to artisan command
        $this->commands('command.create.controller','command.create.model','command.create.module','command.create.view');
    }
    protected function registerCreateModel()
    {
        $this->app->singleton('command.create.model',function ($app)
        {
            return new CreateModel($app['files']);
        });
    }
    protected function registerCreateModule()
    {
        $this->app->singleton('command.create.module',function ($app)
        {
            return new CreateModule($app['files']);
        });
    }
    protected function registerCreateView()
    {
        $this->app->singleton('command.create.view',function ($app)
        {
            return new CreateView($app['files']);
        });
    }
    protected function registerCreateController()
    {
        $this->app->singleton('command.create.controller',function ($app)
        {
            return new CreateController($app['files']);
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
