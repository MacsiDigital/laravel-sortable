<?php

namespace MacsiDigital\Sortable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MacsiDigital\Sortable\Skeleton\SkeletonClass
 */
class Sortable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sortable';
    }
}
