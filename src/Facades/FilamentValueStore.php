<?php

namespace Mstfkhazaal\FilamentValueStore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mstfkhazaal\FilamentValueStore\FilamentValueStore
 */
class FilamentValueStore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mstfkhazaal\FilamentValueStore\FilamentValueStore::class;
    }
}
