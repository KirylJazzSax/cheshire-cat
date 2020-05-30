<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 10:37
 */

namespace Src\Http;


class HtmlResponse extends Response
{
    public function __construct($body, $status = 200, $headers = [])
    {
        parent::__construct(
            $body,
            $status,
            $headers[] = ['Content-Type' => 'text/html; charset=utf-8']);
    }
}