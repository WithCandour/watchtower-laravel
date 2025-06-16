<?php

namespace Watchtower\WatchtowerLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Watchtower\WatchtowerLaravel\WatchtowerLaravel
 */
class WatchtowerLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Watchtower\WatchtowerLaravel\WatchtowerLaravel::class;
    }
}
