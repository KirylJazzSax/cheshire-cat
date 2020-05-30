<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 8:55
 */

namespace Src\Http;

class Response
{
    private $status;
    private $body;
    private $headers;

    private $phrases = [
        200 => 'OK',
        404 => 'Not found',
        400 => 'Bad request',
        405 => 'Method not allowed',
        500 => 'Internal server error'
    ];

    public function __construct($body, $status = 200, $headers = [])
    {
        $this->body = $body;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function withHeader(string $name, $value): self
    {
        $new = clone $this;
        $new->headers[$name] = $value;
        return $new;
    }

    public function getStatusCode(): int
    {
        return $this->status;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getPhrases(): array
    {
        return $this->phrases;
    }
}