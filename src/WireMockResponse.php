<?php
namespace Wiremock;


class WireMockResponse extends WireMockBase
{
    /**
     * @var string
     */
    private $body = '';

    /**
     * @var int
     */
    private $status = 200;

    public function __construct() {}

    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function withBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function toArray()
    {
        $this->formatHeaders();
        return [
                'status' => $this->status,
                'body' => $this->body,
                'headers' => $this->formatHeaders()
            ];
    }

    private function formatHeaders()
    {
        $tmp = array_map(function($elt){
                $key = key($elt);
                return '"'.$key.'": "'.$elt[$key].'"';
            },
            $this->headers
        );

        return implode(',', $tmp);
    }
}