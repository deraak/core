<?php

namespace Deraak\Core\Support\Json;

use Deraak\Core\Contracts\Abstracts\Json as AbstractsJson;

class Json extends AbstractsJson
{
    public function instance(...$args): Json
    {
        return new Json($args);
    }

    public function response(int $status = 200, string $message = '', array $data = [], array $errors = [])
    {
        return response()->json([
            'status'                => $status,
            'success'               => ($status >= 200 && $status <= 299) ? true : false,
            'message'               => $message,
            'errors'                => $errors,
            'data'                  => $data
        ], $status);
    }
}
