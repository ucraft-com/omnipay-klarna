<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Psr\Http\Message\ResponseInterface;

class CaptureRequest extends AbstractRequest
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
        return $this->getApiUrl().'/ordermanagement/v1/orders/captures/'.$this->getTransactionReference();
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionReference', 'amount');

        $data = ['captured_amount' => $this->getOrderAmount()];

        if (null !== $this->getOrderLines()) {
            $data['order_lines'] = $this->getOrderLines();
        }

        return $data;
    }


    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Messages\CaptureResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): CaptureResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
        }

        return new CaptureResponse($this, $data);
    }
}
