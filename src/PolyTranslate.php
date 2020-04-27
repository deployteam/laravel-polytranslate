<?php


namespace DeployTeam\PolyTranslate;

use Str;
use Lang;
use Illuminate\Foundation\Application;

class PolyTranslate
{
    /**
     * The Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Normalized Laravel Version
     *
     * @var string
     */
    protected $version;

    /**
     * True when this is a Lumen application
     *
     * @var bool
     */
    protected $is_lumen = false;

    /**
     * @param Application $app
     */
    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
        $this->version = $app->version();
        $this->is_lumen = Str::contains($this->version, 'Lumen');
    }

    /**
     * @param string|array $path
     */
    public function addPath($path)
    {
        if(!is_array($path)) {
            Lang::getLoader()->addPath($path);
            return;
        }

        foreach($path as $item) {
            Lang::getLoader()->addPath($item);
        }
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param string $namespace
     * @param string|array $path
     * @return void
     */
    public function addNamespace($namespace, $path)
    {
        if(!is_array($path)) {
            Lang::getLoader()->addNamespace($namespace, $path);
            return;
        }

        foreach($path as $item) {
            Lang::getLoader()->addNamespace($namespace, $item);
        }
    }
}
