<?php

namespace Deraak\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Math instance(...$args)
 * 
 * @method static Math setParams(array $params)
 * @method static int getPrecision()
 * @method static bool getTrimTrailingZeroes()
 * 
 * 
 * @method static string convertScientificNumber(float $number)
 * @method static string number(float $number, bool $numberFormat = false)
 * 
 * @method static string add(float $a, float $b)
 * @method static string subtract(float $a, float $b)
 * @method static string multiply(float $a, float $b)
 * @method static string divide(float $a, float $b)
 * @method static string modulus(float $a, float $b)
 * 
 * @method static bool greaterThan(float $a, float $b)
 * @method static bool greaterThanOrEqual(float $a, float $b)
 * @method static bool lessThan(float $a, float $b)
 * @method static bool lessThanOrEqual(float $a, float $b)
 * @method static bool equal(float $a, float $b)
 * @method static bool notEqual(float $a, float $b)
 * 
 * @method static bool decimalPlaceNumber(float $a, float $b)
 *
 * @see \Deraak\Core\Support\Math\Math
 */
class Math extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'math';
    }
}
