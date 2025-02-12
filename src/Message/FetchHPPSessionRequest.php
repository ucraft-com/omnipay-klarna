<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Psr\Http\Message\ResponseInterface;

class FetchHPPSessionRequest extends AbstractRequest
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
        return $this->getApiUrl().'/hpp/v1/sessions/'.$this->getSessionId();
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('session_id');

        return [];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     *
     * @return \Uc\Omnipay\Klarna\Message\FetchHPPSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): FetchHPPSessionResponse
    {
        $data = $this->getResponseBody($httpResponse);

        return new FetchHPPSessionResponse($this, $data);
    }
}
