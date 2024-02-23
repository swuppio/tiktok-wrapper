<?php

declare(strict_types=1);

namespace swuppio\ttWrapper;

use swuppio\ttWrapper\contract\ApiContract;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpBuilder
{
    private array $options = [];

    public function __construct(
        private ?HttpClientInterface $client = null
    ) {
        $this->client = $client ?? HttpClient::create();
        $this->setBaseOptions();
    }

    private function resetOptions(): self
    {
        $this->options = [];
        $this->setBaseOptions();

        return $this;
    }

    private function setBaseOptions()
    {
        $this->options['base_uri'] = ApiContract::ApiHost->value;
    }

    public function setBearer(string $bearer): self
    {
        $this->options['auth_bearer'] = $bearer;

        return $this;
    }

    public function setHeaders(array $headers): self
    {
        return $this->setOption('headers', $headers);
    }

    public function setBody(array $body): self
    {
        return $this->setOption('body', $body);
    }

    public function setQuery(array $query): self
    {
        return $this->setOption('query', $query);
    }

    public function setJson(array $json): self
    {
        return $this->setOption('json', $json);
    }

    public function setOption(string $optionName, array $optionData): self
    {
        $this->options[$optionName] = $optionData;

        return $this;
    }

    public function post(string $uri): array
    {
        $response = $this->client->request('POST', $uri, $this->options);
        ErrorHandler::check($response);

        return $response->toArray(false);
    }

    public function get(string $uri): array
    {
        $response = $this->client->request('GET', $uri, $this->options);
        ErrorHandler::check($response);

        return $response->toArray(false);
    }
}