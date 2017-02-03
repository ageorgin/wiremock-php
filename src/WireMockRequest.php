<?php
namespace Wiremock;


class WireMockRequest extends WireMockBase
{
    /**
     * @var string
     */
    private $method = '';

    /**
     * @var string
     */
    private $url = '';

    /**
     * @var WireMockResponse
     */
    private $response;

    public function __construct($url, $method)
    {
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * @param WireMockResponse $response
     * @return $this
     */
    public function willReturn(WireMockResponse $response)
    {
        $this->response = $response;
        return $this;
    }

    public function toArray()
    {
        return
            [
                'request' => [
                    'method' => $this->method,
                    'url' => $this->url,
                ],
                'response' => $this->response->toArray()
            ];

    }
}