<?php

namespace SoftinkLab\LaravelKeyvalueStorage\Facades;

use Illuminate\Support\Facades\Facade;

class KVOption extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kvoption';
    }
}
