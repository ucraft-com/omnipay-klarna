<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Uc\Omnipay\Klarna\Messages\AcknowledgeRequest;
use Uc\Omnipay\Klarna\Messages\CaptureRequest;
use Uc\Omnipay\Klarna\Messages\CreateSessionRequest;
use Uc\Omnipay\Klarna\Messages\FetchHPPSessionRequest;
use Uc\Omnipay\Klarna\Messages\FetchTransactionRequest;
use Uc\Omnipay\Klarna\Messages\HPPSessionRequest;
use Uc\Omnipay\Klarna\Messages\RefundRequest;
use Uc\Omnipay\Klarna\Traits\GatewayParameters;

/**
 * Klarna gateway.
 *
 * @package Omnipay\Klarna
 */
class Gateway extends AbstractGateway
{
    use GatewayParameters;

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
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function createSession(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(CreateSessionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function createHPPSession(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(HPPSessionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function fetchHPPSession(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(FetchHPPSessionRequest::class, $parameters);
    }


    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function fetchTransaction(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(FetchTransactionRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function capture(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function refund(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    /**
     * @param array $options
     *
     * @return \Uc\Omnipay\Klarna\Messages\AbstractRequest
     */
    public function acknowledge(array $options = []): AbstractRequest
    {
        return $this->createRequest(AcknowledgeRequest::class, $options);
    }
}
