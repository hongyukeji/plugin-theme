<?php

use Hongyukeji\PluginTheme\Util as Util;

class UtilTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @return  herp_derp
     */
    public function testLowercaseToClassName()
    {
        $new = new Util();
        $new->lowercaseToClassName('HERP DERP');
    }
}
