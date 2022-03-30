<?php

namespace Deraak\Core\Contracts\Interfaces;

interface Math
{
    public function instance(...$args): Math;

    public function setParams(array $params): Math;

    public function getPrecision(): int;

    public function getTrimTrailingZeroes(): bool;


    public function convertScientificNumber(float $number): string;

    public function number(float $number, bool $numberFormat = false): string;


    public function add(float $a, float $b): string;

    public function subtract(float $a, float $b): string;

    public function multiply(float $a, float $b): string;

    public function divide(float $a, float $b): string;

    public function modulus(float $a, float $b): string;


    public function greaterThan(float $a, float $b): bool;

    public function greaterThanOrEqual(float $a, float $b): bool;

    public function lessThan(float $a, float $b): bool;

    public function lessThanOrEqual(float $a, float $b): bool;

    public function equal(float $a, float $b): bool;

    public function notEqual(float $a, float $b): bool;



    public function decimalPlaceNumber(float $decimal): int;
}
