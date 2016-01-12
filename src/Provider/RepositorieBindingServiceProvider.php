<?php

namespace Bitdev\ModuleGenerator\Providers;

use Illuminate\Support\ServiceProvider;

class RepositorieBindingServiceProvider extends ServiceProvider
{

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
        $this->registerRepositories();
    }
    public function registerRepositories()
    {
       $this->app->bind('RepoBind',function ()
       {
           return new \Bitdev\ModuleGenerator\RepositorieBinding\RepositorieBinding($this->app);
       });
       require_once app_path('Repositories/Repo.php');
    }
    public function provide()
    {
        return [];
    }
}
