<?php

namespace Cjl\Easykuaidi;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    /**
     * Boot the provider.
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/config.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('easykuaidi.php')], 'easykuaidi');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('easykuaidi');
        }

        $this->mergeConfigFrom($source, 'easykuaidi');
    }


    public function register()
    {
        $this->setupConfig();

        $this->app->singleton(Easykuaidi::class, function(){
            return new Easykuaidi(config('easykuaidi'));
        });

        $this->app->alias(Easykuaidi::class, 'easykuaidi');
    }

    public function provides()
    {
        return [Easykuaidi::class, 'easykuaidi'];
    }
}