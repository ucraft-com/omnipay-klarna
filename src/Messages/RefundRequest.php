<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Psr\Http\Message\ResponseInterface;

class RefundRequest extends AbstractRequest
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
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    protected function getEndpoint(): string
    {
        $this->validate('transactionReference');

        return $this->getApiUrl().'/ordermanagement/v1/orders/'.$this->getTransactionReference().'/refunds';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('refunded_amount');

        $data = ['refunded_amount' => (float)$this->getRefundAmount()];

        if (null !== $this->getRefundReason()) {
            $data['description'] = $this->getRefundReason();
        }

        return $data;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\RefundResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): RefundResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
            $data['refund_id'] = $response->$httpResponse('Refund-Id') ?? null;
            ;
        }

        return new RefundResponse($this, $data);
    }
}
