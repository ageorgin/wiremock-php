<?php
namespace Wiremock;

use \GuzzleHttp\ClientInterface;
use Wiremock\Exception\HealthCheckException;

class WireMockServer
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->healthCheck();
    }

    public function stubFor(WireMockRequest $request) {
        //var_dump($request->toJson());
        $response = $this->client->request('POST', '__admin/mappings', [
            'json' => $request->toArray()
        ]);

        var_dump($response->getStatusCode());
    }

    /**
     * @throws HealthCheckException
     */
    private function healthCheck()
    {
        $response = $this->client->request('GET', '__admin/');

        if (200 !== $response->getStatusCode()) {
            throw new HealthCheckException("Error while loading WiremockServer");
        }

        $jsonResponse = json_decode((string)$response->getBody());

        if (!is_array($jsonResponse->mappings)) {
            throw new HealthCheckException("Error while loading WiremockServer");
        }
    }
}
