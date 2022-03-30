<?php

namespace Deraak\Core\Support\Math;

use Deraak\Core\Contracts\Abstracts\Math as AbstractsMath;

class Math extends AbstractsMath
{
    public int $precision = 10;
    public bool $trimTrailingZeroes = true;

    public function getPrecision(): int
    {
        return $this->precision;
    }

    public function getTrimTrailingZeroes(): bool
    {
        return $this->trimTrailingZeroes;
    }

    public function instance(...$args): Math
    {
        return new Math($args);
    }

    public function convertScientificNumber(float $number): string
    {
        return (string) sprintf("%.10f", floatval($number));
    }

    public function number(float $number, bool $numberFormat = false): string
    {
        $precision = $this->getPrecision();
        $number = $this->convertScientificNumber($number);

        $explode = explode('.', $number);
        $real = $explode[0] ?? 0;
        $decimal = substr($explode[1] ?? 0, 0, $precision);
        $number = $real . "." . $decimal;

        if ($numberFormat) {
            $number = number_format($number, $precision);
        }

        if ($this->getTrimTrailingZeroes()) {
            $number = strpos($number, '.') !== false ? rtrim(rtrim($number, '0'), '.') : $number;
        }

        return (string) $number;
    }

    public function numberFormat(float $number): string
    {
        return $this->number($number, true);
    }

    public function add(float $a, float $b): string
    {
        return (string) $this->number(
            bcadd(
                $this->convertScientificNumber($a),
                $this->convertScientificNumber($b),
                $this->getPrecision()
            )
        );
    }

    public function subtract(float $a, float $b): string
    {
        return (string) $this->number(
            bcsub(
                $this->convertScientificNumber($a),
                $this->convertScientificNumber($b),
                $this->getPrecision()
            )
        );
    }

    public function multiply(float $a, float $b): string
    {
        return (string) $this->number(
            bcmul(
                $this->convertScientificNumber($a),
                $this->convertScientificNumber($b),
                $this->getPrecision()
            )
        );
    }

    public function divide(float $a, float $b): string
    {
        return (string) $this->number(
            bcdiv(
                $this->convertScientificNumber($a),
                $this->convertScientificNumber($b),
                $this->getPrecision()
            )
        );
    }

    public function modulus(float $a, float $b): string
    {
        return (string) $this->number(
            bcmod(
                $this->convertScientificNumber($a),
                $this->convertScientificNumber($b),
                $this->getPrecision()
            )
        );
    }

    public function greaterThan(float $a, float $b): bool
    {
        return (bool)(bccomp(
            $this->convertScientificNumber($a),
            $this->convertScientificNumber($b),
            $this->getPrecision()
        ) == 1);
    }

    public function greaterThanOrEqual(float $a, float $b): bool
    {
        return (bool)(bccomp(
            $this->convertScientificNumber($a),
            $this->convertScientificNumber($b),
            $this->getPrecision()
        ) != -1);
    }

    public function lessThan(float $a, float $b): bool
    {
        return (bool)(bccomp(
            $this->convertScientificNumber($a),
            $this->convertScientificNumber($b),
            $this->getPrecision()
        ) == -1);
    }

    public function lessThanOrEqual(float $a, float $b): bool
    {
        return (bool)(bccomp(
            $this->convertScientificNumber($a),
            $this->convertScientificNumber($b),
            $this->getPrecision()
        ) != 1);
    }

    public function equal(float $a, float $b): bool
    {
        return (bool)(bccomp(
            $this->convertScientificNumber($a),
            $this->convertScientificNumber($b),
            $this->getPrecision()
        ) == 0);
    }

    public function notEqual(float $a, float $b): bool
    {
        return (bool)!$this->equal($a, $b);
    }

    public function decimalPlaceNumber(float $decimal): int
    {
        return (int) strlen(substr(strrchr($this->number($decimal), "."), 1));
    }

    // 
}
