<?php

namespace App\Integrations\Payments;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Psr\Http\Message\UriInterface;

abstract class PaymentGateway
{
    protected $baseUri;

    abstract public function __construct();

    abstract public function handlePayment(Request $request);

    abstract protected function resolveAccessToken(): string;

    public function makeRequest(string $method, string|UriInterface $requestUrl, array $queryParams = [], array $formParams = [], array $headers = [], bool $isJsonRequest = false)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->baseUri,
        ]);

        // check if this method is existed
        if (method_exists($this, 'resolveAuthorization')) {
            // resolve the authorization
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        // make a request
        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams
        ]);

        // get the content of the response of the sent request
        $response = $response->getBody()->getContents();

        // check if this method is existed
        if (method_exists($this, 'decodeResponse')) {
            // decode the response of the sent request
            $response = $this->decodeResponse($response);
        }

        return $response;
    }

    // to decode the response of the sent request
    public function decodeResponse($response): mixed
    {
        return json_decode($response);
    }

    // resolve the factor (to solve zero decimal currency problem)
    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }
        return 100;
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }
}
