<?php
namespace Wiremock;


class WireMock
{
    /**
     * @param $url
     * @return WireMockRequest
     */
    public static function get($url)
    {
        return new WireMockRequest($url, 'GET');
    }

    public static function aResponse()
    {
        return new WireMockResponse();
    }
}