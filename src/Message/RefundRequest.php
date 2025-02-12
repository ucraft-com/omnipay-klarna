<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;
use Throwable;

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
     */
    public function getEndpoint(): string
    {
        return $this->getApiUrl().'/ordermanagement/v1/orders/'.$this->getTransactionReference().'/refunds';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionReference', 'amount');

        $data['refunded_amount'] = $this->getAmountInteger();

        return $data;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\RefundResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): RefundResponse
    {
        $data = $this->getResponseBody($httpResponse);

        try {
            $data['refund_id'] = $httpResponse->getHeader('Refund-Id') ?? null;
        } catch (Throwable) {
            $data['refund_id'] = null;
        }

        return new RefundResponse($this, $data);
    }
}
