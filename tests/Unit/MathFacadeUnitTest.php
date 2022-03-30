<?php

namespace Deraak\Core\Tests\Unit;

use Deraak\Core\Support\Facades\Math;
use Deraak\Core\Tests\TestCase;
use TypeError;
use ErrorException;

class MathFacadeUnitTest extends TestCase
{
    public function test_set_precision_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 8])->precision, 8);
        $this->assertEquals(Math::setParams(['precision' => 'test'])->precision, 0);
        $this->assertEquals(Math::getPrecision(), 10);
    }

    public function test_set_trim_trailing_zeroes()
    {
        $this->assertEquals(Math::setParams(['trimTrailingZeroes' => false])->trimTrailingZeroes, false);
        $this->assertEquals(Math::getTrimTrailingZeroes(), true);
        $this->assertEquals(Math::setParams(['trimTrailingZeroes' => 'test'])->trimTrailingZeroes, true);
    }

    public function test_convert_scientific_number_method()
    {
        $this->assertEquals(Math::convertScientificNumber(11), 11.0000000000);
        $this->assertEquals(Math::convertScientificNumber(11.11), 11.1100000000);
        $this->assertEquals(Math::convertScientificNumber(1.1e+8), 110000000.0000000000);
        $this->assertEquals(Math::convertScientificNumber(1.1e-8), 0.0000000110);
        $this->assertEquals(Math::setParams(['precision' => 8])->convertScientificNumber(1.1e-8), 0.0000000110);
        $this->expectException(TypeError::class);
        Math::convertScientificNumber("test");
    }

    public function test_number_math_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 4])->number(0.44015042), 0.4401);
        $this->assertEquals(Math::number(11.000001000), 11.000001);
        $this->assertEquals(Math::number(1.1e+8), 110000000);
        $this->assertEquals(Math::setParams(['setTrimTrailingZeroes' => false])->number(1.1e+8), 110000000.0000000000);
        $this->expectException(TypeError::class);
        Math::number("test");
    }

    public function test_number_format_method()
    {
        $this->assertEquals(Math::numberFormat(1.1e+8), "110,000,000");
    }

    public function test_add_two_numbers_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 0])->add(5.599, 5.499), 11);
        $this->assertEquals(Math::setParams(['precision' => 4])->add(5.599, 5.499), 11.098);
        $this->assertEquals(Math::add(1.1e+8, 1.1e-8), 110000000.0000000149);
    }

    public function test_subtract_two_numbers_method()
    {
        $this->assertEquals(Math::subtract(5, 6), -1);
        $this->assertEquals(Math::setParams(['precision' => 0])->subtract(5.599, 5.499), 0.0);
        $this->assertEquals(Math::setParams(['precision' => 4])->subtract(5.599, 5.499), 0.1);
        $this->assertEquals(Math::subtract(1.1e+8, 1.1e-8), 109999999.9999999851);
    }

    public function test_multiply_two_numbers_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 1])->multiply(5.125, 6.11), 31.3);
        $this->assertEquals(Math::multiply(1.1e+8, 1.1e-8), 1.21);
    }

    public function test_divide_two_numbers_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 0])->divide(50, 0.4354), 114);
        $this->assertEquals(Math::setParams(['precision' => 0])->divide(361, 1.15), 313);
        $this->assertEquals(Math::divide(5, 6), 0.8333333333);
        $this->assertEquals(Math::divide(1.1e+8, 1.1e-8), 10000000000000000);
        $this->expectException(ErrorException::class);
        Math::divide(5, 0);
    }

    public function test_modulus_two_numbers_method()
    {
        $this->assertEquals(Math::modulus(5, 6), 5);
        $this->assertEquals(Math::modulus(1.1e+8, 1.1e-8), 0);
        $this->expectException(ErrorException::class);
        Math::divide(5, 0);
    }

    public function test_greater_than_numbers_method()
    {
        $this->assertEquals(Math::setParams(['precision' => 1])->greaterThan(1.11, 1.112), false);
        $this->assertEquals(Math::greaterThan(1.1e+8, 1.1e-8), true);
        $this->assertEquals(Math::greaterThan(1.1e+8, 1.1e+8), false);
        $this->assertEquals(Math::greaterThan(1.1e-8, 1.1e+8), false);
    }

    public function test_greater_than_or_equal_numbers_method()
    {
        $this->assertEquals(Math::greaterThanOrEqual(1.1e+8, 1.1e-8), true);
        $this->assertEquals(Math::greaterThanOrEqual(1.1e+8, 1.1e+8), true);
        $this->assertEquals(Math::greaterThanOrEqual(1.1e-8, 1.1e+8), false);
    }

    public function test_less_than_numbers_method()
    {
        $this->assertEquals(Math::lessThan(1.1e-8, 1.1e+8), true);
        $this->assertEquals(Math::lessThan(1.1e+8, 1.1e+8), false);
        $this->assertEquals(Math::lessThan(1.1e+8, 1.1e-8), false);
    }

    public function test_less_than_or_equal_numbers_method()
    {
        $this->assertEquals(Math::lessThanOrEqual(1.1e-8, 1.1e+8), true);
        $this->assertEquals(Math::lessThanOrEqual(1.1e+8, 1.1e+8), true);
        $this->assertEquals(Math::lessThanOrEqual(1.1e+8, 1.1e-8), false);
    }

    public function test_equal_numbers_method()
    {
        $this->assertEquals(Math::equal(1.1e-8, 1.1e+8), false);
        $this->assertEquals(Math::equal(1.1e+8, 1.1e+8), true);
        $this->assertEquals(Math::equal(1.1e+8, 1.1e-8), false);
    }

    public function test_decimal_place_number_method()
    {
        $this->assertEquals(Math::decimalPlaceNumber(0.000000000100), 10);
        $this->assertEquals(Math::decimalPlaceNumber(1), 0);
    }
}
