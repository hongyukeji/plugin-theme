<?php

namespace Hongyukeji\Theme;

class AssetManager extends \Hongyukeji\Package\AssetManager
{
    /**
     * Returns the Package object that created this instance of AssetManager
     *
     * @return  \Hongyukeji\Theme\Theme|null  The Package object that created this instance of AssetManager
     */
    public function getTheme()
    {
        return parent::getPackage();
    }
}
