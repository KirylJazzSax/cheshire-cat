<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 10:04
 */

namespace Src\Http;


class ResponseSender
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->sendStatus();
        $this->sendHeaders();
    }

    private function sendStatus()
    {
        http_response_code($this->response->getStatusCode());
    }

    private function sendHeaders()
    {
        foreach ($this->response->getHeaders() as $name => $header) {
            header($name . ':' . $header);
        }
    }

    public function send()
    {
        echo $this->response->getBody();
    }
}