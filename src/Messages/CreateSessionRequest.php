<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Psr\Http\Message\ResponseInterface;

class CreateSessionRequest extends AbstractRequest
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
        return $this->getApiUrl().'/payments/v1/sessions';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'order_amount',
            'order_lines',
            'purchase_country',
            'purchase_currency',
            'order_tax_amount',
            'locale'
        );

        $data['merchant_urls'] = $this->getMerchantUrls();
        $data['order_amount'] = $this->getOrderAmount();
        $data['order_lines'] = $this->getOrderLines();
        $data['order_tax_amount'] = $this->getOrderTaxAmount();
        $data['purchase_country'] = $this->getPurchaseCountry();
        $data['purchase_currency'] = $this->getPurchaseCurrency();
        $data['locale'] = $this->getLocale();

        return $data;
    }


    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\CreateSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): CreateSessionResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
            $data['payment_session_url'] = $this->getEndpoint().'/'.$jsonToArrayResponse['session_id'] ?? null;
        }

        return new CreateSessionResponse($this, $data);
    }
}
