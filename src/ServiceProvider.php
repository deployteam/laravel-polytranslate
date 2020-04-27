<?php


namespace DeployTeam\PolyTranslate;


use DeployTeam\PolyTranslate\Translation\FileLoader;
use Illuminate\Translation\TranslationServiceProvider;

class ServiceProvider extends TranslationServiceProvider
{
    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new FileLoader($app['files'], $app['path.lang']);
        });
    }
}

