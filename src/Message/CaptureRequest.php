<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class CaptureRequest extends AbstractOrderRequest
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
        return $this->getApiUrl().'/ordermanagement/v1/orders/'.$this->getTransactionReference().'/captures';
    }

    /**
     * @param int $value
     *
     * @return \Uc\Omnipay\Klarna\Message\CaptureRequest
     */
    public function setCapturedAmount(int $value): CaptureRequest
    {
        return $this->setParameter('captured_amount', $value);
    }

    /**
     * @return int
     */
    public function getCapturedAmount(): int
    {
        return $this->getParameter('captured_amount');
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionReference', 'captured_amount');

        $data['captured_amount'] = $this->getCapturedAmount();

        return $data;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\CaptureResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): CaptureResponse
    {
        $data = $this->getResponseBody($httpResponse);

        try {
            $data['capture_id'] = $httpResponse->getHeader('Capture-Id') ?? null;
        } catch (Throwable) {
            $data['capture_id'] = null;
        }

        return new CaptureResponse($this, $data);
    }
}
