<?php


namespace DeployTeam\PolyTranslate\Translation;

use Illuminate\Translation\FileLoader as Loader;

class FileLoader extends Loader
{
    /**
     * The paths for the loader.
     *
     * @var array
     */
    protected $paths = [];

    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string|null  $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        if ($group === '*' && $namespace === '*') {
            return $this->loadJsonPaths($locale);
        }

        if (is_null($namespace) || $namespace === '*') {
            return $this->loadPaths($locale, $group);
        }

        return $this->loadNamespaced($locale, $group, $namespace);
    }

    /**
     * Load a locale from a given path.
     *
     * @param  string  $path
     * @param  string  $locale
     * @param  string  $group
     * @return array
     */
    private function loadPaths($locale, $group)
    {
        $messages = [];

        $messages[] = $this->loadPath($this->path, $locale, $group);

        foreach($this->paths as $path) {
            $messages[] = $this->loadPath($path, $locale, $group);
        }

        return array_merge([], ...$messages);
    }

    /**
     * Load a namespaced translation group.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @return array
     */
    protected function loadNamespaced($locale, $group, $namespace)
    {
        if (isset($this->hints[$namespace]) && !empty($this->hints[$namespace])) {
            $lines = [];

            foreach($this->hints[$namespace] as $path) {
                $trans = $this->loadPath($path, $locale, $group);

                if (is_array($trans)) {
                    $lines = array_merge($lines, $trans);
                }
            }

            return $this->loadNamespaceOverrides($lines, $locale, $group, $namespace);
        }

        return [];
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param  string  $namespace
     * @param  string  $hint
     * @return void
     */
    public function addNamespace($namespace, $hint)
    {
        if (!array_key_exists($namespace, $this->hints)) {
            $this->hints[$namespace] = [];
        }

        $this->hints[$namespace][] = $hint;
    }

    /**
     * @param string $path
     */
    public function addPath($path)
    {
        $this->paths[] = $path;
    }
}
