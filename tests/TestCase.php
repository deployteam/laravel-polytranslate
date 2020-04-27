<?php


namespace DeployTeam\PolyTranslate\Test;

use DeployTeam\PolyTranslate\Facade;
use DeployTeam\PolyTranslate\ServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Storage;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->addLanguageFiles();
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'PolyTranslate' => Facade::class
        ];
    }

    private function addLanguageFiles()
    {
        Storage::fake('languages');
        $disk = $this->getDisk();

        $disk->put('dir-a/en/header.php', <<<EOT
<?php
return [
  'login' => 'Login',
  'logout' => 'Logout'
];
EOT
        );

        $disk->put('dir-b/en/header.php', <<<EOT
<?php
return [
  'greeting' => 'Hello',
  'login' => 'Sign in'
];
EOT
        );
    }

    protected function getDisk()
    {
        return Storage::disk('languages');
    }
}
