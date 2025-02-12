<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;

class FetchTransactionRequest extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getApiUrl().'/ordermanagement/v1/orders/'.$this->getTransactionReference();
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
     * @return \Uc\Omnipay\Klarna\Message\FetchTransactionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): FetchTransactionResponse
    {
        $data = $this->getResponseBody($httpResponse);

        return new FetchTransactionResponse($this, $data);
    }
}
