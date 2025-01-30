<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

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
    protected function getEndpoint(): string
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
        $this->validate('payment_session_url');

        $data['payment_session_url'] = $this->getPaymentSessionUrl();
        $data['merchant_urls'] = $this->getMerchantUrls();
        $data['options'] = [
            'place_order_mode' => $this->getOrderMode(),
            'page_title' => 'Klarna'
        ];

        return $data;
    }


    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\HPPSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): HPPSessionResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
        }

        return new HPPSessionResponse($this, $data);
    }
}
