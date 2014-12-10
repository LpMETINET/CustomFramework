<?php

namespace Iut\Http;

class Request
{
    private $headers = [];
    private $body;
    private $method;
    private $uri;
    private $query = [];

    public function __construct(array $headers, $body, $method, $uri, array $query)
    {
        $this->headers  = $headers;
        $this->body     = $body;
        $this->method   = $method;
        $this->uri      = $uri;
        $this->query    = $query;
    }

    /**
     * Factory Pattern
     */
    static public function createFromGlobals()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            //var_dump($key, $value);
            if (0 === strpos($key, 'HTTP_')) {
                $normalizedHeaderName = substr($key, 5);
                $normalizedHeaderName = str_replace(
                    '_',
                    '-',
                    $normalizedHeaderName
                );
                $normalizedHeaderName = strtolower($normalizedHeaderName);
                $headers[] = new Header($normalizedHeaderName, $value);
            }
        }

        $body = file_get_contents('php://input');

        $method = $_SERVER['REQUEST_METHOD'];

        $uri = $_SERVER['REQUEST_URI'];

        $rawQuery = isset($_SERVER['QUERY_STRING'])
            ? $_SERVER['QUERY_STRING']
            : ''
        ;

        parse_str($rawQuery, $query);

        $request = new self(
            $headers,
            $body,
            $method,
            $uri,
            $query
        );

        return $request;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getHeader($name) {
        foreach($this->headers as $header) {
            if ($header->getName() === $name) {

                return $header;
            }
        }
    }

    public function getBody() {
        return $this->body;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getUri() {
        return $this->uri;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getQueryParam($paramName) {
        return isset($this->query[$paramName])
            ? $this->query[$paramName]
            : null
        ;
    }
}
