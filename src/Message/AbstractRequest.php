<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Money\Money;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Uc\Omnipay\Klarna\Item\ItemBag;
use Uc\Omnipay\Klarna\Traits\CurrencyAwareTrait;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Throwable;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use CurrencyAwareTrait;

    /**
     * @var string[]
     */
    public static array $liveApiEndpoints = [
        'EU' => 'https://api.klarna.com',
        'NA' => 'https://api-na.klarna.com',
        'OC' => 'https://api-oc.klarna.com'
    ];

    /**
     * @var string[]
     */
    public static array $testApiEndpoints = [
        'EU' => 'https://api.playground.klarna.com',
        'NA' => 'https://api-na.playground.klarna.com',
        'OC' => 'https://api-oc.playground.klarna.com'
    ];

    /**
     * @param string $region
     *
     * @return $this
     */
    public function setRegion(string $region): self
    {
        $this->setParameter('region', $region);

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->getParameter('region');
    }

    /**
     * @param string $secret
     *
     * @return $this
     */
    public function setSecret(string $secret): self
    {
        $this->setParameter('secret', $secret);

        return $this;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->getParameter('secret');
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->setParameter('username', $username);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getParameter('username');
    }

    /**
     * @return Money|null
     */
    public function getAmount(): ?Money
    {
        if (null === $amount = $this->getParameter('amount')) {
            return null;
        }

        return $this->convertToMoney($amount);
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->getParameter('locale');
    }

    /**
     * @return string|null
     */
    public function getMerchantReference1(): ?string
    {
        return $this->getParameter('merchant_reference1');
    }

    /**
     * @return string|null
     */
    public function getMerchantReference2(): ?string
    {
        return $this->getParameter('merchant_reference2');
    }

    /**
     * The total tax amount of the order
     *
     * @return Money|null
     */
    public function getTaxAmount(): ?Money
    {
        if (null === $amount = $this->getParameter('tax_amount')) {
            return null;
        }

        return $this->convertToMoney($amount);
    }

    /**
     * @param string $baseUrl
     *
     * @return $this
     */
    public function setBaseUrl(string $baseUrl): self
    {
        $this->setParameter('base_url', $baseUrl);

        return $this;
    }

    /**
     * @param $items
     *
     * @return $this
     */
    public function setItems($items): self
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new ItemBag($items);
        }

        $this->setParameter('items', $items);

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $this->setParameter('locale', $locale);
    }

    /**
     * @param string $merchantReference
     *
     * @return $this
     */
    public function setMerchantReference1(string $merchantReference): self
    {
        $this->setParameter('merchant_reference1', $merchantReference);

        return $this;
    }

    /**
     * @param string $merchantReference
     *
     * @return $this
     */
    public function setMerchantReference2(string $merchantReference): self
    {
        $this->setParameter('merchant_reference2', $merchantReference);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return void
     */
    public function setTaxAmount(float $value): void
    {
        $this->setParameter('tax_amount', $value);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setSessionId(string $value): void
    {
        $this->setParameter('session_id', $value);
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->getParameter('session_id');
    }

    /**
     * @param array $merchantUrls
     *
     * @return void
     */
    public function setMerchantUrls(array $merchantUrls): void
    {
        $this->setParameter('merchant_urls', $merchantUrls);
    }

    /**
     * @return array|null
     */
    public function getMerchantUrls(): ?array
    {
        return $this->getParameter('merchant_urls');
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function setOptions(array $options): void
    {
        $this->setParameter('options', $options);
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->getParameter('options');
    }

    /**
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * @return string
     */
    abstract protected function getHttpMethod(): string;

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\AbstractResponse
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
            'Cache-Control' => 'no-cache',
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

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function getResponseBody(PsrResponseInterface $response): array
    {
        try {
            return json_decode($response->getBody()->getContents(), true);
        } catch (Throwable) {
            return [];
        }
    }
}
