<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;

class HPPSessionRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getApiUrl().'/hpp/v1/sessions';
    }

    /**
     * @param string $sessionUrl
     *
     * @return void
     */
    public function setPaymentSessionUrl(string $sessionUrl): void
    {
        $this->setParameter('payment_session_url', $sessionUrl);
    }

    /**
     * @return string
     */
    public function getPaymentSessionUrl(): string
    {
        return $this->getParameter('payment_session_url');
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('payment_session_url', 'merchant_urls');

        $data['payment_session_url'] = $this->getPaymentSessionUrl();
        $data['merchant_urls'] = $this->getMerchantUrls();

        if (null !== $this->getOptions()) {
            $data['options'] = $this->getOptions();
        }

        return $data;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\HPPSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): HPPSessionResponse
    {
        $data = $this->getResponseBody($httpResponse);

        return new HPPSessionResponse($this, $data);
    }
}
