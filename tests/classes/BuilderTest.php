<?php

use Hongyukeji\PluginTheme\Loader as Loader;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        $this->theme()->refreshConfig();
    }

    /**
     *
     * @return  \Hongyukeji\PluginTheme\Loader
     */
    public function load()
    {
        $loader = Loader::forge();
        $loader->addDir('themes', __DIR__.'/../mock/');

        return $loader;
    }

    /**
     *
     * @return  \Hongyukeji\PluginTheme\Theme
     */
    public function theme()
    {
        $loader = $this->load();

        return $loader->get('themes', 'hongyukeji/foolfake-theme-fake');
    }

    /**
     *
     * @return  \Hongyukeji\PluginTheme\Builder
     */
    public function bld()
    {
        return $this->theme()->createBuilder();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('Hongyukeji\PluginTheme\Builder', $this->bld());
    }

    public function testGetTheme()
    {
        $this->assertInstanceOf('Hongyukeji\PluginTheme\Theme', $this->bld()->getTheme());
    }

    public function testGetParamManager()
    {
        $this->assertInstanceOf('Hongyukeji\PluginTheme\ParamManager', $this->bld()->getParamManager());
    }

    public function testCreateLayout()
    {
        $this->assertInstanceOf('Hongyukeji\PluginTheme\View', $this->bld()->createLayout('this_layout'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Layout\ThisLayout', $this->bld()->createLayout('this_layout'));
    }

    public function testCreatePartial()
    {
        $this->assertInstanceOf('Hongyukeji\PluginTheme\View', $this->bld()->createPartial('one_partial', 'this_partial'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Partial\ThisPartial', $this->bld()->createPartial('one_partial', 'this_partial'));
    }

    public function testGetLayout()
    {
        $bld = $this->bld();
        $bld->createLayout('this_layout');
        $this->assertInstanceOf('Hongyukeji\PluginTheme\View', $bld->getLayout('this_layout'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Layout\ThisLayout', $bld->getLayout('this_layout'));
    }

    public function testGetPartial()
    {
        $bld = $this->bld();
        $bld->createPartial('one_partial', 'this_partial');
        $this->assertInstanceOf('Hongyukeji\PluginTheme\View', $bld->getPartial('one_partial', 'this_partial'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Partial\ThisPartial', $bld->getPartial('one_partial', 'this_partial'));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage The layout wasn't set.
     */
    public function testGetLayoutThrowsBadMethodCall()
    {
        $this->bld()->getLayout();
    }

    /**
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage No such partial exists.
     */
    public function testGetPartialThrowsOutOfBounds()
    {
        $this->bld()->getPartial('derp');
    }
    
    public function testBuild()
    {
        $bld = $this->bld();
        $bld->createLayout('this_layout');
        $this->assertSame('A fake layout.', $bld->build());
    }
}
