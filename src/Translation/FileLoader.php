<?php


namespace DeployTeam\PolyTranslate\Translation;

use Illuminate\Translation\FileLoader as Loader;

class FileLoader extends Loader
{
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
}
