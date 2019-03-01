<?php

namespace MacsiDigital\Sortable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MacsiDigital\Sortable\Skeleton\SkeletonClass
 */
class SortableFacade extends Facade
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
