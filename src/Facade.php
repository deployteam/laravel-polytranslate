<?php


namespace DeployTeam\PolyTranslate;

/**
 * @method static void addPath(string|array $path)
 * @method static void addNamespace(string $namespace, string|array $path)
 *
 * @see \DeployTeam\PolyTranslate\PolyTranslate
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return PolyTranslate::class;
    }
}
