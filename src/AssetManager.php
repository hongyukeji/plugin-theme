<?php

namespace Hongyukeji\PluginTheme;

class AssetManager extends \Hongyukeji\PluginPackage\AssetManager
{
    /**
     * Returns the Package object that created this instance of AssetManager
     *
     * @return  \Hongyukeji\PluginTheme\Theme|null  The Package object that created this instance of AssetManager
     */
    public function getTheme()
    {
        return parent::getPackage();
    }
}
