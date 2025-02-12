<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Uc\Omnipay\Klarna\Message\CancelRequest;
use Uc\Omnipay\Klarna\Message\CaptureRequest;
use Uc\Omnipay\Klarna\Message\FetchHPPSessionRequest;
use Uc\Omnipay\Klarna\Message\FetchTransactionRequest;
use Uc\Omnipay\Klarna\Message\HPPSessionRequest;
use Uc\Omnipay\Klarna\Message\PaymentSessionRequest;
use Uc\Omnipay\Klarna\Message\RefundRequest;

/**
 * Klarna gateway.
 *
 * @package Omnipay\Klarna
 */
class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'Klarna Payments';
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'testMode' => true,
            'username' => '',
            'secret'   => ''
        ];
    }

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
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Message\AbstractRequest
     */
    public function createPaymentSession(array $parameters = []): RequestInterface
    {
        return $this->createRequest(PaymentSessionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Message\AbstractRequest
     */
    public function createHPPSession(array $parameters = []): RequestInterface
    {
        return $this->createRequest(HPPSessionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function fetchHPPSession(array $parameters = []): RequestInterface
    {
        return $this->createRequest(FetchHPPSessionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function capture(array $parameters = []): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function fetchTransaction(array $parameters = []): RequestInterface
    {
        return $this->createRequest(FetchTransactionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function refund(array $parameters = []): RequestInterface
    {
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function cancel(array $parameters = []): RequestInterface
    {
        return $this->createRequest(CancelRequest::class, $parameters);
    }
}
