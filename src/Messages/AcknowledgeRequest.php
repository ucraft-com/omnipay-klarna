<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Psr\Http\Message\ResponseInterface;

class AcknowledgeRequest extends AbstractRequest
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

        return $this->getApiUrl().'/ordermanagement/v1/orders/acknowledge/'.$this->getTransactionReference();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [];
    }


    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\AcknowledgeResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): AcknowledgeResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
        }

        return new AcknowledgeResponse($this, $data);
    }
}
