<?php

namespace RatingCaptain\SynonymizedTextGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RatingCaptain\SynonymizedTextGenerator\Skeleton\SkeletonClass
 */
class SynonymizedTextGeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'synonymized-text-generator';
    }
}
