<?php

namespace Kastanaz\Lutility\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kastanaz\Lutility\Lutility
 */
class Lutility extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kastanaz\Lutility\Lutility::class;
    }
}
