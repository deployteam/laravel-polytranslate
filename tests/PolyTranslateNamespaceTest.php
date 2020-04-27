<?php


namespace DeployTeam\PolyTranslate\Test;

use PolyTranslate;
use Lang;
use Storage;

class PolyTranslateNamespaceTest extends TestCase
{
    /** @test */
    public function itShouldNotFindTranslationIfNoExtraPathsAdded()
    {
        $key = 'test::header.login';

        $this->assertEquals($key, Lang::get($key), 'Translation should not exist');
    }

    /** @test */
    public function itShouldReturnTranslationFromASingleFile()
    {
        PolyTranslate::addNamespace('test', $this->getDisk()->path('dir-a'));

        $this->assertEquals('Login', Lang::get('test::header.login'), 'Translation key is missing');
    }

    /** @test */
    public function itShouldOverrideTranslationFromFirstFile()
    {
        PolyTranslate::addNamespace('test', [
            $this->getDisk()->path('dir-a'),
            $this->getDisk()->path('dir-b')
        ]);

        $this->assertEquals('Sign in', Lang::get('test::header.login'), 'Translation was not overwritten');
    }

    /** @test */
    public function itShouldLoadExtraTranslationFromLastFile()
    {
        PolyTranslate::addNamespace('test', [
            $this->getDisk()->path('dir-a'),
            $this->getDisk()->path('dir-b')
        ]);

        $this->assertEquals('Hello', Lang::get('test::header.greeting'), 'Translation was not loaded');
    }
}
