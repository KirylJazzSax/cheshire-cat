<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 10:28
 */

namespace Src\Http;


class JsonResponse extends Response
{
    public function __construct($body, $status = 200, $headers = [])
    {
        parent::__construct(
            json_encode($body, JSON_UNESCAPED_UNICODE),
            $status,
            $headers[] = ['Content-Type' => 'application/json']);
    }
}