<?php

namespace Terpomoj\LaravelEncore\Facade;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Terpomoj\LaravelEncore\Encore
 * @method static Htmlable getLinkTags(string $entryName)
 * @method static Htmlable getScriptTags(string $entryName, bool $nodefer = false)
 */
class Encore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return static::class;
    }
}
