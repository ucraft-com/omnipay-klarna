<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Uc\Omnipay\Klarna\Traits\GatewayParameters;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Throwable;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use GatewayParameters;

    /**
     * @var string[]
     */
    public static array $liveApiEndpoints = [
        'europe'       => 'https://api.klarna.com/',
        'northAmerica' => 'https://api-na.klarna.com/',
        'oceania'      => 'https://api-oc.klarna.com/'
    ];

    /**
     * @var string[]
     */
    public static array $testApiEndpoints = [
        'europe'       => 'https://api.playground.klarna.com/',
        'northAmerica' => 'https://api-na.playground.klarna.com/',
        'oceania'      => 'https://api-oc.playground.klarna.com/'
    ];

    /**
     * @return string
     */
    abstract protected function getEndpoint(): string;

    /**
     * @return string
     */
    abstract protected function getHttpMethod(): string;

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractResponse
     */
    abstract protected function createResponse(PsrResponseInterface $httpResponse): AbstractResponse;

    /**
     * @return array
     */
    abstract public function getData(): array;

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        $testMode = $this->getTestMode();
        $region = $this->getRegion();

        if ($testMode) {
            return static::$testApiEndpoints[$region];
        }

        return static::$liveApiEndpoints[$region];
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        $auth = base64_encode($this->getUsername().':'.$this->getSecret());

        return [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic '.$auth,
        ];
    }

    /**
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     * @throws \JsonException
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData(mixed $data): ResponseInterface
    {
        $body = empty($data) ? null : json_encode($data, JSON_THROW_ON_ERROR);
        try {
            $response = $this->httpClient->request(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                $this->getHeaders(),
                $body,
            );

            return $this->createResponse($response);
        } catch (Throwable $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: '.$e->getMessage(),
                $e->getCode()
            );
        }
    }
}
