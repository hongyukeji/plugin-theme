<?php

use Hongyukeji\Theme\Theme as Theme;
use Hongyukeji\Theme\Loader as Loader;

class ThemeTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @return  \Hongyukeji\Theme\Loader
     */
    public function load()
    {
        if ( ! file_exists(__DIR__.'/../public')) {
            mkdir(__DIR__.'/../public');
        }

        $loader = Loader::forge();
        $loader->addDir('themes', __DIR__.'/../mock/');
        $loader->setBaseUrl("");
        $loader->setPublicDir(__DIR__."/../public");

        return $loader;
    }

    /**
     *
     * @return  \Hongyukeji\Theme\Theme
     */
    public function theme()
    {
        $loader = $this->load();
        
        return $loader->get('themes', 'hongyukeji/foolfake-theme-fake');
    }

    public function testTheme()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\Theme', $this->theme());
    }

    public function testCreateBuilder()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\Builder', $this->theme()->createBuilder());
    }

    public function testGetAssetManager()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\AssetManager', $this->theme()->getAssetManager());
    }

    /**
     * @expectedException        \OutOfBoundsException
     * @expectedExceptionMessage No theme to extend.
     */
    public function testGetExtendedThrowsOutOfBoundsNull()
    {
        $loader = $this->load();
        $loader->get('themes', 'hongyukeji/foolfake-theme-fake');
        $this->theme()->getExtended();
    }

    public function testGetNamespace()
    {
        $loader = $this->load();
        $loader->get('themes', 'hongyukeji/foolfake-theme-fake');
        $this->assertSame('Hongyukeji\Foolfake\Theme\Fake', $this->theme()->getNamespace());
    }
}
