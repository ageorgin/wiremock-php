<?php
namespace Wiremock;


class WireMockBase
{
    /**
     * @var array
     */
    protected $headers = [];

    public function __construct() {}

    public function withHeader($header, $value)
    {
        $this->headers[] = [
            $header => $value
        ];
        return $this;
    }
}