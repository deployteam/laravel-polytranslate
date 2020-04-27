<?php


namespace DeployTeam\PolyTranslate\Test;

use PolyTranslate;
use Lang;
use Storage;

class PolyTranslateNoNamespaceTest extends TestCase
{
    /** @test */
    public function itShouldNotFindTranslationIfNoExtraPathsAdded()
    {
        $key = 'header.login';

        $this->assertEquals($key, Lang::get($key), 'Translation should not exist');
    }

    /** @test */
    public function itShouldReturnTranslationFromASingleFile()
    {
        PolyTranslate::addPath($this->getDisk()->path('dir-a'));

        $this->assertEquals('Login', Lang::get('header.login'), 'Translation key is missing');
    }

    /** @test */
    public function itShouldOverrideTranslationFromFirstFile()
    {
        PolyTranslate::addPath([
            $this->getDisk()->path('dir-a'),
            $this->getDisk()->path('dir-b')
        ]);

        $this->assertEquals('Sign in', Lang::get('header.login'), 'Translation was not overwritten');
    }

    /** @test */
    public function itShouldLoadExtraTranslationFromLastFile()
    {
        PolyTranslate::addPath([
            $this->getDisk()->path('dir-a'),
            $this->getDisk()->path('dir-b')
        ]);

        $this->assertEquals('Hello', Lang::get('header.greeting'), 'Translation was not loaded');
    }
}
