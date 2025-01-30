<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

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
    protected function getEndpoint(): string
    {
        return $this->getApiUrl().'/hpp/v1/sessions/'.$this->getSessionId();
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
     * @return \Uc\Omnipay\Klarna\Messages\FetchHPPSessionResponse
     */
    protected function createResponse(ResponseInterface $httpResponse): FetchHPPSessionResponse
    {
        $data = [];

        $response = $httpResponse->getBody()->getContents();
        $jsonToArrayResponse = !empty($response) ? json_decode($response, true) : [];

        if (json_last_error() === JSON_ERROR_NONE && $jsonToArrayResponse !== null) {
            $data = $jsonToArrayResponse;
        }

        return new FetchHPPSessionResponse($this, $data);
    }
}
