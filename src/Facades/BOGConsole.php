<?php

namespace Zorb\BOGConsole\Facades;

use Illuminate\Support\Facades\Facade;
use Zorb\BOGConsole\BOGConsole as BOGConsoleService;

class BOGConsole extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BOGConsoleService::class;
    }
}
