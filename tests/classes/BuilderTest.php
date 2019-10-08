<?php

use Hongyukeji\Theme\Loader as Loader;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        $this->theme()->refreshConfig();
    }

    /**
     *
     * @return  \Hongyukeji\Theme\Loader
     */
    public function load()
    {
        $loader = Loader::forge();
        $loader->addDir('themes', __DIR__.'/../mock/');

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

    /**
     *
     * @return  \Hongyukeji\Theme\Builder
     */
    public function bld()
    {
        return $this->theme()->createBuilder();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\Builder', $this->bld());
    }

    public function testGetTheme()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\Theme', $this->bld()->getTheme());
    }

    public function testGetParamManager()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\ParamManager', $this->bld()->getParamManager());
    }

    public function testCreateLayout()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\View', $this->bld()->createLayout('this_layout'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Layout\ThisLayout', $this->bld()->createLayout('this_layout'));
    }

    public function testCreatePartial()
    {
        $this->assertInstanceOf('Hongyukeji\Theme\View', $this->bld()->createPartial('one_partial', 'this_partial'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Partial\ThisPartial', $this->bld()->createPartial('one_partial', 'this_partial'));
    }

    public function testGetLayout()
    {
        $bld = $this->bld();
        $bld->createLayout('this_layout');
        $this->assertInstanceOf('Hongyukeji\Theme\View', $bld->getLayout('this_layout'));
        $this->assertInstanceOf('Hongyukeji\Foolfake\Theme\Fake\Layout\ThisLayout', $bld->getLayout('this_layout'));
    }

    public function testGetPartial()
    {
        $bld = $this->bld();
        $bld->createPartial('one_partial', 'this_partial');
        $this->assertInstanceOf('Hongyukeji\Theme\View', $bld->getPartial('one_partial', 'this_partial'));
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
