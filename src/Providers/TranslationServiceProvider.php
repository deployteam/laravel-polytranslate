<?php


namespace DeployTeam\PolyTranslate\Providers;


use DeployTeam\PolyTranslate\Translation\FileLoader;
use Illuminate\Translation\TranslationServiceProvider as Provider;

class TranslationServiceProvider extends Provider
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

