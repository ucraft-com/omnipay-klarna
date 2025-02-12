<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;

class CancelRequest extends AbstractOrderRequest
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
        return $this->getApiUrl().'/ordermanagement/v1/orders/'.$this->getTransactionReference().'/cancel';
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionReference');

        return [];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\CancelResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): CancelResponse
    {
        $data = $this->getResponseBody($httpResponse);

        return new CancelResponse($this, $data);
    }
}
