<?php

namespace Deraak\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Json instance(...$args)
 * @method static bool is($string)
 * @method static string encode($mixed, int $flags = 0, int $depth = 512)
 * @method static mixed decode($json, $associative = null, int $depth = 512, int $flags = 0)
 * @method static json response(int $status = 200, string $message = '', array $data = [], array $errors = [])
 * 
 * @see \Deraak\Core\Support\Json\Json
 */
class Json extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'json';
    }
}
