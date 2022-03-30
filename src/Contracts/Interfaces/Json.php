<?php

namespace Deraak\Core\Contracts\Interfaces;

interface Json
{
    public function instance(...$args): Json;

    public function is($string): bool;

    public function encode($mixed, int $flags = 0, int $depth = 512);

    public function decode($json, $associative = NULL, int $depth = 512, int $flags = 0);

    public function response(int $status = 200, string $message = '', array $data = [], array $errors = []);
}
