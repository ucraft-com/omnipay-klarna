<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;

class PaymentSessionRequest extends AbstractOrderRequest
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
        return $this->getApiUrl().'/payments/v1/sessions';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'amount',
            'currency',
            'items',
            'locale',
            'purchase_country',
            'tax_amount',
        );

        $data = $this->getOrderData();

        if (null !== $this->getMerchantUrls()) {
            $data['merchant_urls'] = $this->getMerchantUrls();
        }

        if (null !== $this->getOptions()) {
            $data['options'] = $this->getOptions();
        }

        return $data;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\PaymentSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): PaymentSessionResponse
    {
        $data = $this->getResponseBody($httpResponse);

        return new PaymentSessionResponse($this, $data);
    }
}
