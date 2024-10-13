<?php

namespace Saade\FilamentSqlField\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Saade\FilamentSqlField\FilamentSqlField
 */
class FilamentSqlField extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Saade\FilamentSqlField\FilamentSqlField::class;
    }
}
