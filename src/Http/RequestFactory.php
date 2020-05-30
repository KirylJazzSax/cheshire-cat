<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 17:07
 */

namespace Src\Http;


class RequestFactory
{
    public static function fromGlobals(array $params)
    {
        if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = $params['csrf'];
        }

        return (new Request())
            ->withQueryParams($_GET)
            ->withParsedBody($_POST)
            ->withSession($_SESSION)
            ->withServerParams($_SERVER);
    }
}