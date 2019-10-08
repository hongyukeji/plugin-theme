<?php

use Hongyukeji\PluginTheme\Loader;

class LoaderTest extends PHPUnit_Framework_TestCase
{
    public function testGetTheme()
    {
        $new = Loader::forge('default');
        $new->addDir('test', __DIR__.'/../../tests/mock/');
        $theme = $new->get('test', 'hongyukeji/foolfake-theme-fake');
        $this->assertInstanceOf('Hongyukeji\PluginTheme\Theme', $theme);
    }
}
