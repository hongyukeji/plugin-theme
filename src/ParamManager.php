<?php

namespace Hongyukeji\PluginTheme;

class ParamManager
{
    /**
     * The parameters (which can be modified with setParam())
     *
     * @var  array  Array with as keys the parameter key
     */
    protected $params = [];

    /**
     * Resets the object to the initial state
     *
     * @return  \Hongyukeji\PluginTheme\ParamManager  The current object
     */
    public function reset()
    {
        $this->params = [];

        return $this;
    }

    /**
     * Returns the array of parameters
     *
     * @return  array  The array of parameters
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Returns the parameter with the key. Supports fallback.
     * It uses func_num_args() so if a second parameter is passed, it will use it as fallback.
     *
     * @param   string  $key
     * @return  mixed  The value of the parameter
     *
     * @throws  \OutOfBoundsException If the key is not set
     */
    public function getParam($key)
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }

        // return a second parameter
        if (func_num_args() === 2) {
            return func_get_arg(1);
        }

        throw new \OutOfBoundsException('Undefined parameter.');
    }

    /**
     * Updates a parameter
     *
     * @param   string  $key    The key for the value
     * @param   mixed   $value  The value
     *
     * @return  \Hongyukeji\PluginTheme\ParamManager  The current object
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Updates several parameters
     *
     * @param   array  $array  Array with as keys the parameter key and as value the parameter value
     * @return  \Hongyukeji\PluginTheme\ParamManager
     */
    public function setParams($array)
    {
        foreach ($array as $key => $item) {
            $this->params[$key] = $item;
        }

        return $this;
    }
}
