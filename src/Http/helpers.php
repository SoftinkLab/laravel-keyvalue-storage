<?php

if (!function_exists('kvoption')) {
    /**
     * Get / Set the specified option.
     *
     * For set option, array should be passed.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed|\SoftinkLab\LaravelKeyvalueStorage\KVOption
     */
    function kvoption($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('kvoption');
        }

        if (is_array($key)) {
            return app('kvoption')->setArray($key);
        }

        return app('kvoption')->get($key, $default);
    }
}

if (!function_exists('kvoption_exists')) {
    /**
     * Check the specified option exits by key.
     *
     * @param  string  $key
     * @return mixed
     */
    function kvoption_exists($key)
    {
        return app('option')->exists($key);
    }
}
