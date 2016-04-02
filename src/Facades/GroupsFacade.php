<?php

namespace Musonza\Groups\Facades;

use Illuminate\Support\Facades\Facade;

class GroupsFacade extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'groups';
    }
}
