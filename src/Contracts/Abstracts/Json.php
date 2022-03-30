<?php

namespace Deraak\Core\Contracts\Abstracts;

use Deraak\Core\Contracts\Interfaces\Json as InterfacesJson;
use stdClass;

abstract class Json implements InterfacesJson
{
    public function is($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string);
        if (json_last_error() == JSON_ERROR_NONE) {
            return true;
        }
        return false;
    }

    public function encode($mixed, int $flags = 0, int $depth = 512)
    {
        return (is_resource($mixed)) ? '' : (($this->is($mixed)) ? $mixed : json_encode($mixed, $flags, $depth));
    }

    public function decode($json, $associative = NULL, int $depth = 512, int $flags = 0)
    {
        return (!is_string($json) || !$this->is($json)) ? ((empty($json)) ? $this->type($json) : $json) : json_decode($json, $associative, $depth, $flags);
    }

    protected function type($value)
    {
        return $this->types()[gettype($value)];
    }

    protected function types(): array
    {
        return [
            'boolean'       => false,
            'integer'       => 0,
            'double'        => 0,
            'string'        => '',
            'array'         => [],
            'object'        => new stdClass,
            'resource'      => '',
            'NULL'          => NULL,
            'unknown type'  => ''
        ];
    }
}
