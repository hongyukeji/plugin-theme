<?php

namespace Hongyukeji\PluginTheme;

class View
{
    /**
     * Instance of builder that created this View
     *
     * @var  \Hongyukeji\PluginTheme\Builder
     */
    protected $builder;

    /**
     * Instance of a props object
     *
     * @var  \Hongyukeji\PluginTheme\Props
     */
    protected $props = null;

    /**
     * The type of view, if partial or layout
     *
     * @var  string
     */
    protected $type;

    /**
     * The name of the view to recall
     *
     * @var  string
     */
    protected $view;

    /**
     * The result of the build process
     *
     * @var  null|string  Null if not yet built, string otherwise
     */
    protected $built = null;

    /**
     * Construct a View, it may be partial or layout
     *
     * @param  \Hongyukeji\PluginTheme\Builder  $builder  The Builder object creating this view
     * @param  string                $type     The type of view, it can be partial or layout
     * @param  string                $view     The name of the view
     *
     * @return  \Hongyukeji\PluginTheme\View  The new view
     */
    public static function forge(\Hongyukeji\PluginTheme\Builder $builder, $type, $view)
    {
        // get the View object in case it can be found
        $theme = $builder->getTheme();
        do {
            $class = $theme->getNamespace().ucfirst($type).'\\'.Util::lowercaseToClassName($view);

            if (class_exists($class)) {
                $new = new $class();

                break;
            }

        } while ($theme = $theme->getExtended());

        $new->setBuilder($builder);
        $new->setType($type);
        $new->setView($view);
        $new->setParamManager(new ParamManager());

        return $new;
    }

    /**
     * Set the builder
     *
     * @param \Hongyukeji\PluginTheme\Builder $builder
     * @return \Hongyukeji\PluginTheme\View
     */
    public function setBuilder(\Hongyukeji\PluginTheme\Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * Returns the Builder that created the View
     *
     * @return  \Hongyukeji\PluginTheme\Builder  The Builder object
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Returns the global parameter manager located in the builder
     *
     * @return  \Hongyukeji\PluginTheme\ParamManager  The ParamManager that belongs to the Builder
     */
    public function getBuilderParamManager()
    {
        return $this->getBuilder()->getParamManager();
    }

    /**
     * Returns the theme that belongs to this view
     *
     * @return  \Hongyukeji\PluginTheme\Theme  The Theme that created this View
     */
    public function getTheme()
    {
        return $this->getBuilder()->getTheme();
    }

    /**
     * Returns the asset manager that belongs to the theme that created this view
     *
     * @return  \Hongyukeji\PluginTheme\AssetManager The Theme's AssetManager
     */
    public function getAssetManager()
    {
        return $this->getTheme()->getAssetManager();
    }

    /**
     * Set the type of view
     *
     * @param  string  $type  The type of view
     *
     * @return  \Hongyukeji\PluginTheme\View  The current object
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the type of View
     *
     * @return  string  The type of view
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the view
     * It won't change the view once the View object is created
     *
     * @param  string  $view  The name of the view
     *
     * @return  \Hongyukeji\PluginTheme\View  The current object
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Returns the type of view
     *
     * @return  string  The type of view
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Sets the Parameter Manager
     *
     * @param  \Hongyukeji\PluginTheme\ParamManager  $param_manager  The parameter manager
     *
     * @return  \Hongyukeji\PluginTheme\View  The current object
     */
    public function setParamManager(\Hongyukeji\PluginTheme\ParamManager $param_manager)
    {
        $this->param_manager = $param_manager;

        return $this;
    }

    /**
     * Returns the ParamManager for the View
     *
     * @return  \Hongyukeji\PluginTheme\ParamManager  The Parameter Manger to pass variables to the view
     */
    public function getParamManager()
    {
        return $this->param_manager;
    }

    /**
     * Flushes the built content to the browser if we're in streaming mode
     */
    public function flush()
    {
        if ($this->getBuilder()->isStreaming()) {
            flush();
        }
    }

    /**
     * Return the compiled view
     *
     * @return  string  The compiled view
     */
    public function build()
    {
        if ($this->built === null) {
            $this->doBuild();
        }

        return $this->built;
    }

    /**
     * Compiles the view
     *
     * @return  \Hongyukeji\PluginTheme\View  The current object
     */
    public function doBuild()
    {
        ob_start();
        $this->toString();
        $this->setBuilt(ob_get_clean());

        return $this;
    }

    /**
     * Allows modifying the string of the built view
     *
     * @param string $string The string to set as built
     *
     * @return $this
     */
    public function setBuilt($string)
    {
        $this->built = $string;

        return $this;
    }

    /**
     * Clears the Built cache, run to save memory
     */
    public function clearBuilt()
    {
        $this->setBuilt(null);
    }

    /**
     * Method to override to echo the content of the theme
     *
     * @throws  \BadMethodCallException  If not overridden
     */
    public function toString()
    {
        throw new \BadMethodCallException('The toString() method must be overridden to output the theme content');
    }
}
