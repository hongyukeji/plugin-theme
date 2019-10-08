<?php

use Hongyukeji\Theme\Loader;

class LoaderTest extends PHPUnit_Framework_TestCase
{
    public function testGetTheme()
    {
        $new = Loader::forge('default');
        $new->addDir('test', __DIR__.'/../../tests/mock/');
        $theme = $new->get('test', 'hongyukeji/foolfake-theme-fake');
        $this->assertInstanceOf('Hongyukeji\Theme\Theme', $theme);
    }
}
