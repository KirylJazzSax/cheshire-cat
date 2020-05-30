<?php

namespace Src\Http;

class Request
{
    private $queryParams;
    private $parsedBody;
    private $serverParams;
    private $session;
    private $attributes;

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function withQueryParams(array $queryParams): self
    {
        $new = clone $this;
        $new->queryParams = $queryParams;
        return $new;
    }

    public function withParsedBody($parsedBody): self
    {
        $new = clone $this;
        $new->parsedBody = $parsedBody;
        return $new;
    }

    public function getServerParams()
    {
        return $this->serverParams;
    }

    public function withServerParams(array $serverParams): self
    {
        $new = clone $this;
        $new->serverParams = $serverParams;
        return $new;
    }

    public function getPath(): string
    {
        return parse_url($this->serverParams['REQUEST_URI'])['path'];
    }
    public function getMethod(): string
    {
        return $this->serverParams['REQUEST_METHOD'];
    }

    public function withResponseCode(int $code): void
    {
        http_response_code($code);
    }

    public function withAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $attribute) {
            $this->attributes[$key] = $attribute;
        }
    }

    public function getAttribute(string $key)
    {
        return $this->attributes[$key];
    }

    public function isPost(): bool
    {
        return  $this->getMethod() === 'POST';
    }

    public function isAjax(): bool
    {
        if (isset($this->serverParams['HTTP_X_REQUESTED_WITH'])) {
            return strtolower($this->serverParams['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        }
        return false;
    }

    public function withSession(array $session)
    {
        $new = clone $this;
        $new->session = $session;
        return $new;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function setSessionValue($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function getSessionValue($key)
    {
        return isset($this->session[$key]) ? $this->session[$key] : null;
    }
}